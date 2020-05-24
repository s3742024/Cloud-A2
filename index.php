<?php

// Disclaimer: This is an university assignment application that 
//             is developed based on the booktshelf tutorial provided by google cloud. 
 
 
if (!getenv('GOOGLE_CLOUD_PROJECT')) {
    throw new Exception('Missing GOOGLE_CLOUD_PROJECT environment variable');
}

require_once __DIR__ . '/vendor/autoload.php';


// initialize logger and error handler.
Google\Cloud\ErrorReporting\Bootstrap::init();


// create app
$app = new Laravel\Lumen\Application(__DIR__);


// register container bindings
$app->singleton(
    Illuminate\Contracts\Debug\ExceptionHandler::class,
    App\Exceptions\Handler::class
);


// Load Routes
$app->router->group([
    'namespace' => 'App\Http\Controllers',
], function ($router) {
    require __DIR__ . '/controller.php';
});


// Run 
$app->run();
