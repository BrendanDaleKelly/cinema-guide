<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Auth\AuthenticationException;

class Handler extends ExceptionHandler
{
    // A list of the exception types that are not reported.
    protected $dontReport = [
        //
    ];

    // A list of the inputs that are never flashed for validation exceptions.
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    // Report or log an exception. This is a great spot to send exceptions to Sentry, Bugsnag, etc.
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    // Render an exception into an HTTP response.
    public function render($request, Exception $exception)
    {
        // Replace the HTML 404 response with a JSON response.
        if ($exception instanceof ModelNotFoundException) {
            return response()->json(['error' => 'Resource not found'], 404);
        }

        return parent::render($request, $exception);
    }

    // Return a JSON error message when an authentication exception is thrown.
    public function unauthenticated($request, AuthenticationException $exception)
    {
        return response()->json(['error' => 'Unauthenticated'], 401);
    }
}
