<?php

// Disclaimer: This is an university assignment application that 
//             is developed based on the booktshelf tutorial provided by google cloud. 

ob_start() ?>


<br>
<br>
<h3 class="text-center">Receipt Details</h3>
<br>
<br>

   <div class="container table-responsive">
        <table class="table table-hover ">

    <thead>
      <tr>
        <th>Deduction Category</th>
        <th>Business Name</th>
        <th>Product/Service</th>
        <th>Purchased Date</th>
        <th>Receipt Type</th>
        <th>Expense</th>
        <th>Edit</th>
        <th>Bin</th>
      </tr>
    </thead>

    <div class="media">
      <div class="media-body">

        <tbody>
          <tr>
            <td><a href="/receipts/<?= $receipt->id() ?>"> <?= $receipt->get('deduction_category') ?></a></td>
            <td><a href="/receipts/<?= $receipt->id() ?>"> <?= $receipt->get('business_name') ?></a></td>
            <td><a href="/receipts/<?= $receipt->id() ?>"> <?= $receipt->get('product_service') ?></a></td>
            <td><a href="/receipts/<?= $receipt->id() ?>"> <?= $receipt->get('purchased_date') ?></a></td>
            <td><a href="/receipts/<?= $receipt->id() ?>"> <?= $receipt->get('receipt_type') ?></a></td>
            <td><a href="/receipts/<?= $receipt->id() ?>"> <?= $receipt->get('expense') ?></a></td>

            <td>
              <a href="/receipts/<?= $receipt->id() ?>/edit">
                <svg class="bi bi-pencil-square" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                  <path d="M15.502 1.94a.5.5 0 010 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 01.707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 00-.121.196l-.805 2.414a.25.25 0 00.316.316l2.414-.805a.5.5 0 00.196-.12l6.813-6.814z" />
                  <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 002.5 15h11a1.5 1.5 0 001.5-1.5v-6a.5.5 0 00-1 0v6a.5.5 0 01-.5.5h-11a.5.5 0 01-.5-.5v-11a.5.5 0 01.5-.5H9a.5.5 0 000-1H2.5A1.5 1.5 0 001 2.5v11z" clip-rule="evenodd" />
                </svg>
              </a>
            </td>

            <td>
              <form method="post" action="/receipts/<?= $receipt->id() ?>/delete" id="deleteForm">
                <button id="submit" type="submit" class=" btn-link">
                  <svg class="bi bi-trash" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path d="M5.5 5.5A.5.5 0 016 6v6a.5.5 0 01-1 0V6a.5.5 0 01.5-.5zm2.5 0a.5.5 0 01.5.5v6a.5.5 0 01-1 0V6a.5.5 0 01.5-.5zm3 .5a.5.5 0 00-1 0v6a.5.5 0 001 0V6z" />
                    <path fill-rule="evenodd" d="M14.5 3a1 1 0 01-1 1H13v9a2 2 0 01-2 2H5a2 2 0 01-2-2V4h-.5a1 1 0 01-1-1V2a1 1 0 011-1H6a1 1 0 011-1h2a1 1 0 011 1h3.5a1 1 0 011 1v1zM4.118 4L4 4.059V13a1 1 0 001 1h6a1 1 0 001-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" clip-rule="evenodd" />
                  </svg>
                </button>
              </form>
            </td>
          </tr>
        </tbody>
      </div>
    </div>
  </table>
</div>

<br>
<br>

<div>
  <?php if ($imgUrl = $receipt->get('image_url')) : ?>

<div  class="text-right mr-5">
    <a href="<?= $imgUrl ?>"  class="ml-4 text-dark text-center"> Download File 
      <div  class="ml-4">
      <img class="mx-auto d-block img-fluid " download width="" height="" src="<?= $imgUrl ?>" />
      </div>
    </a>
</div>

  <?php endif ?>
</div>

<br>
<br>

<?= view('header', ['content' => ob_get_clean()]) ?>