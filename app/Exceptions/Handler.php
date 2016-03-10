<?php

namespace Learner\Exceptions;

use Exception;
use Learner\Exceptions\CribbbException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        AuthorizationException::class,
        HttpException::class,
        ModelNotFoundException::class,
        ValidationException::class,
        CribbbException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $e
     * @return void
     */
    public function report(Exception $e)
    {
        return parent::report($e);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $e
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $e)
    {
        if ($e instanceOf CribbbException) {
            $data   = $e->toArray();
            $status = $e->getStatus();

            if ($e instanceOf VideoNotFoundHttpException) {
                $data = array_merge([
                    'id'     => 'video_not_found',
                    'status' => '404'
                ], config('errors.video_not_found'));

                $status = 404;

            }

            return response()->json($data, $status);
        }


        return parent::render($request, $e);
    }

    /**
     * Convert the Exception into a JSON HTTP Response
     *
     * @param Request $request
     * @param Exception $e
     * @return JSONResponse
     */
    private function handle($request, Exception $e) {
        if ($e instanceOf CribbbException) {
            $data   = $e->toArray();
            $status = $e->getStatus();
        }

        if ($e instanceOf VideoNotFoundHttpException) {
            $data = array_merge([
                'id'     => 'video_not_found',
                'status' => '404'
            ], config('errors.video_not_found'));

            $status = 404;
        }

        return response()->json($data, $status);
    }
}
