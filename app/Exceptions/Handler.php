<?php

namespace App\Exceptions;

use Exception;
use Laravel\Lumen\Exceptions\Handler as ExceptionHandler;
use Google\Cloud\ErrorReporting\Bootstrap;

class Handler extends ExceptionHandler
{
    //@param  \Exception  $exception
    //@return void
    
    public function report(Exception $exception)
    {
        // Send errors to Stackdriver Error Reporting
        Bootstrap::exceptionHandler($exception);
        parent::report($exception);
    }
}
