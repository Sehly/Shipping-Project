<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;


class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    // public function render($request, Throwable $exception)
    // {
    //     // Handle AuthenticationException
    //     if ($exception instanceof AuthenticationException) {
    //         // If the request expects JSON, return a JSON response
    //         if ($request->expectsJson()) {
    //             return response()->json(['message' => 'You must be logged in to access this resource.'], 401);
    //         }
    
    //         // Otherwise, redirect to login page
    //         return redirect()->guest(route('login'));
    //     }
    
    //     // Handle RouteNotFoundException (typically when route authentication fails)
    //     if ($exception instanceof RouteNotFoundException) {
    //         // Check if it's an API request expecting JSON
    //         if ($request->expectsJson()) {
    //             return response()->json(['message' => 'Resource not found.'], 404);
    //         }
    
    //         // For non-JSON requests, return a 404 view or response
    //         return response()->view('errors.404', [], 404);
    //     }
    
        // For all other exceptions, use the default Laravel behavior
    //     return parent::render($request, $exception);
    // }
    
    // public function render($request, Exception $exception)
    // {
        
    //     if ($exception instanceof AuthenticationException) {
    //         return response()->json(['message' => 'You must be logged in to access this resource.'], 401);
    //     }

        
    //     if ($exception instanceof RouteNotFoundException) {
    //         return response()->json(['message' => 'Resource not found.'], 404);
    //     }

    //     return parent::render($request, $exception);
    // }

}
