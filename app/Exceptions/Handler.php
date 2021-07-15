<?php

namespace App\Exceptions;

use Throwable;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\UnauthorizedException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Laravel\Lumen\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        HttpException::class,
        ModelNotFoundException::class
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Throwable  $exception
     * @return void
     *
     * @throws \Exception
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {
        if ($exception instanceof ValidationException) {
            return response()->json([
                'type' => 2,
                'message' => $exception->errors()
            ], $exception->status);
        } elseif ($exception instanceof AuthorizationException ||
                    $exception instanceof Spatie\Permission\Exceptions\UnauthorizedException
        ) {
            return response()->json([
                'type' => 2,
                'message' => 'This action is forbidden'
            ], FORBIDDEN);
        } elseif ($exception instanceof NotFoundHttpException) {
            return response()->json([
                'type' => 2,
                'message' => 'Page not found'
            ], HTTP_NOT_FOUND);
        } elseif ($exception instanceof MethodNotAllowedHttpException) {
            return response()->json([
                'type' => 2,
                'message' => 'Method not allowed'
            ], METHOD_NOT_ALLOWED);
        } elseif ($exception instanceof AuthenticationException) {
            return response()->json([
                'type' => 2,
                'message' => 'Unauthenticated'
            ], UNAUTHORIZED_USER);
        }

        return parent::render($request, $exception);
    }
}
