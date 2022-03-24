<?php

namespace App\Exceptions;

use Error;
use Throwable;
use ParseError;
use ErrorException;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\QueryException;
use Illuminate\Auth\AuthenticationException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;

class Handler extends ExceptionHandler
{

    /**
     * A list of the exception types that are not reported.
     *
     * @var string[]
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var string[]
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
            Log::error($e->getMessage());
        });

        $this->renderable(function (AuthenticationException  $e, $request) {
            return response()->json([
                'status' => 'Failed',
                'message' => 'Unauthenticated',
                'data' => []
            ], 401);
        });

        $this->renderable(function (NotFoundHttpException $e, $request) {
            return response()->json([
                'status' => 'Failed',
                // 'message' => 'Not found',
                'message' => empty($e->getMessage()) ? 'URL is not reachable' : 'Record not found',
                'data'  => []
            ], $e->getStatusCode());
        });

        $this->renderable(function (MethodNotAllowedHttpException $e, $request) {
            return response()->json([
                'status' => 'Failed',
                // 'message' => 'Not found',
                'message' => 'Method not allowed',
                'data'  => []
            ], $e->getStatusCode());
        });

        // $this->renderable(function (QueryException $e, $request) {
        //     return response()->json([
        //         'status' => 'Failed',
        //         'message' => 'Other error',
        //         'data' => []
        //     ], 500);
        // });

        $this->renderable(function (HttpException $e, $request) {
            return response()->json([
                'status' => 'Failed',
                'message' => $e->getMessage(),
                'data'  => []
            ], $e->getStatusCode());
        });

        // $this->renderable(function (ParseError $e, $request) {
        //     return response()->json([
        //         'status' => 'Failed',
        //         'message' => 'Other error',
        //         'data'  => []
        //     ], 500);
        // });

        // $this->renderable(function (Error $e, $request) {
        //     return response()->json([
        //         'status' => 'Failed',
        //         'message' => 'Other error',
        //         'data'  => []
        //     ], 500);
        // });

        // $this->renderable(function (ErrorException $e, $request) {
        //     return response()->json([
        //         'status' => 'Failed',
        //         'message' => 'Other error',
        //         'data'  => []
        //     ], 500);
        // });

    }
}
