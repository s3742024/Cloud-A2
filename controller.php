<?php
// Disclaimer: This is an university assignment application that 
//             is developed based on the booktshelf tutorial provided by google cloud. 


use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Google\Cloud\Core\Exception\FailedPreconditionException;


$projectId = getenv('GOOGLE_CLOUD_PROJECT');

$collectionName = getenv('FIRESTORE_COLLECTION') ?: 'receipts';
$receiptFields = ['id', 'deduction_category', 'business_name', 'product_service',
 'purchased_date', 'expense', 'receipt_type', 'expense', "image_url"];



// call Firestore
use Google\Cloud\Firestore\FirestoreClient;

$firestore = new FirestoreClient([
    'projectId' => $projectId,
]);
$collection =  $firestore->collection($collectionName);


// call Cloud Storage
use Google\Cloud\Storage\StorageClient;

$storage = new StorageClient([
    'projectId' => $projectId,
]);
$bucketId = $projectId . '_bucket';
$gcsBucket = $storage->bucket($bucketId);



// home
$router->get('/', function (Request $request) use ($collection) {
    $pageSize = getenv('PAGE_SIZE') ?: 8;
    $query = $collection->limit($pageSize)->orderBy('deduction_category');
    if ($token = $request->query->get('page_token')) {
        $lastreceipt = $collection->document($token)->snapshot();
        $query = $query->startAfter($lastreceipt);
    }
    try {
        $receipts = $query->documents();
    } catch (FailedPreconditionException $e) {
        $receipts = [];
    }
    return view('home', [
        'receipts' => $receipts,
        'pageSize' => $pageSize,
    ]);
});



// add receipt.
$router->get('/receipts/add', function () {
    return view('add', [
        'action' => 'Add',
        'receipt' => null,
    ]);
});


// validate receipt 
$router->post('/receipts/add', function (Request $request) use ($collection, $gcsBucket, $receiptFields) {
    $receiptData = $request->request->all();

    if ($invalid = array_diff_key($receiptData, array_flip($receiptFields))) {
        throw new \Exception('unsupported field: ' . implode(', ', array_keys($invalid)));
    }

    $image = $request->files->get('image');
    if ($image && $image->isValid()) {
        $file = fopen($image->getRealPath(), 'r');
        $object = $gcsBucket->upload($file, [
            'metadata' => ['contentType' => $image->getMimeType()],
            'predefinedAcl' => 'publicRead',
        ]);
        $receiptData['image_url'] = $object->info()['mediaLink'];
    }

    // Create receipt
    $receiptRef = $collection->newDocument();
    $receiptRef->set($receiptData);

    return redirect('/receipts/' . $receiptRef->id());
});


// summary report
$router->get('/receipts/summary', function (Request $request) use ($collection) {

    $startTime = $request->request->get('start_time','');
    $endTime = $request->request->get('end_time','');

    if (!empty($startTime))  $collection = $collection->where('purchased_date','>=',$startTime);
    if (!empty($endTime))  $collection = $collection->where('purchased_date','<',$endTime);

    $receipts = $collection->documents();

    $list = [
        ['name' => 'D1 Car Expenses', 'value' => 0],
        ['name' => 'D2 Travel Expenses', 'value' => 0],
        ['name' => 'D3 Clothing & Laundry Expenses', 'value' => 0],
        ['name' => 'D4 Self-education Expenses', 'value' => 0],
        ['name' => 'D5 Other Work-related Expenses', 'value' => 0],
        ['name' => 'D6 Low-value Pool Deduction', 'value' => 0],
        ['name' => 'D7 Interest Deductions', 'value' => 0],
        ['name' => 'D8 Dividend Deductions', 'value' => 0],
        ['name' => 'D9 Gifts or Donations', 'value' => 0],
        ['name' => 'D10 Tax Affair Managing Cost', 'value' => 0],
    ];

    foreach ($receipts as $val) {
        foreach ($list as $k => $v) {
            if ($val->get('deduction_category') == $v['name']) $list[$k]['value'] += $val->get('expense');
          
        }
    }

    return view('summary', [
        'action' => 'Add',
        'list' => $list,
        'query' => [
            'start_time'=>$startTime,
            'end_time'=>$endTime,
        ]

    ]);
});

$router->get('/receipts/generate', function (Request $request) use ($collection) {
    return view('generate-item', [
        'action' => '',
        'list' => '',
    ]);
});


// display details and image
$router->get('/receipts/{receiptId}', function ($receiptId) use ($collection) {

    $receiptRef = $collection->document($receiptId);
    $snapshot = $receiptRef->snapshot();

    if (!$snapshot->exists()) {
        return new Response('', Response::HTTP_NOT_FOUND);
    }

    return view('display', ['receipt' => $snapshot]);
});


// edit receipt
$router->get('/receipts/{receiptId}/edit', function ($receiptId) use ($collection) {
    $receiptRef = $collection->document($receiptId);
    $snapshot = $receiptRef->snapshot();

    if (!$snapshot->exists()) {
        return new Response('', Response::HTTP_NOT_FOUND);
    }

    return view('add', [
        'action' => 'Edit',
        'receipt' => $snapshot,
    ]);
});


$router->post('/receipts/{receiptId}/edit', function (Request $request, $receiptId) use ($collection, $gcsBucket, $receiptFields) {
    $receiptRef = $collection->document($receiptId);
    $snapshot = $receiptRef->snapshot();

    if (!$snapshot->exists()) {
        return new Response('', Response::HTTP_NOT_FOUND);
    }

    // Get receipt by id
    $receiptData = $request->request->all();
    $receiptData['id'] = $receiptId;

    // Validate data
    if ($invalid = array_diff_key($receiptData, array_flip($receiptFields))) {
        throw new \Exception('unsupported field: ' . implode(', ', array_keys($invalid)));
    }

    $image = $request->files->get('image');
    if ($image && $image->isValid()) {
        $file = fopen($image->getRealPath(), 'r');
        $object = $gcsBucket->upload($file, [
            'metadata' => ['contentType' => $image->getMimeType()],
            'predefinedAcl' => 'publicRead',
        ]);
        $receiptData['image_url'] = $object->info()['mediaLink'];
    }

    $receiptRef->set($receiptData, ['merge' => true]);
    return redirect('/receipts/' . $receiptId);
});


// Delete receipt
$router->post('/receipts/{receiptId}/delete', function ($receiptId) use ($collection, $gcsBucket) {
    $receiptRef = $collection->document($receiptId);
    $snapshot = $receiptRef->snapshot();

    if (!$snapshot->exists()) {
        return new Response('', Response::HTTP_NOT_FOUND);
    }

    $receiptRef->delete();

    if ($imageUrl = $snapshot->get('image_url')) {
        $components = explode('/', parse_url($imageUrl, PHP_URL_PATH));
        $name = $components[count($components) - 1];
        $object = $gcsBucket->object($name);
        $object->delete();
    }

    return redirect('/', Response::HTTP_SEE_OTHER);
});


// Logging
$router->get('/logs', function (Request $request) {
    $message = 'This is custom log entry';
    $monolog = new Monolog\Logger('app');
    $monolog->info($request->get('message') ?: $message);
    return redirect('/');
});

// Error Reporting
$router->get('/errors', function (Request $request) {
    $message = 'This is an exception.';
    throw new \Exception($request->get('message') ?: $message);
});
