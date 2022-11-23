<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
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
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
        $this->renderable(function (Throwable $e) {

            if (request()->wantsJson()) {
                if ($e instanceof \Symfony\Component\HttpKernel\Exception\BadRequestHttpException) {
                    return response()->json([
                        'message' => 'Bad request.'
                    ], 400);
                }

                if ($e instanceof \Illuminate\Auth\AuthenticationException) {
                    return response()->json([
                        'message' => 'Unauthenticated.'
                    ], 401);
                }

                if ($e instanceof \Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException) {
                    return response()->json([
                        'message' => 'Unauthorized.'
                    ], 401);
                }

                if ($e instanceof \Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException) {
                    return response()->json([
                        'message' => 'Access denied.'
                    ], 403);
                }

                if ($e instanceof \Symfony\Component\HttpKernel\Exception\NotFoundHttpException) {
                    return response()->json([
                        'message' => 'Not found.'
                    ], 404);
                }

                if ($e instanceof \Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException) {
                    return response()->json([
                        'message' => 'Method not allowed.'
                    ], 405);
                }

                return response()->json([
                    'message' => 'Server error.',
                    'error' => $e->getMessage()
                ], $e->getCode() ?: 500);
            }
        });
    }
}
