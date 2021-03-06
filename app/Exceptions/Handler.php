<?php

namespace App\Exceptions;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Facades\View;
use Illuminate\View\FileViewFinder;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
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
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {
        $finder = new FileViewFinder(app()['files'], array(resource_path().'/views/site'));
        View::setFinder($finder);

        if ($exception instanceof ModelNotFoundException) {
            abort(404);
        }

        if ($this->isHttpException($exception)) {
            $errorCode = $exception->getStatusCode();
            if (view()->exists('errors.' . $errorCode)) {
                return response()->view('errors.' . $errorCode, [
                    'errorCode' => $errorCode,
                ], $errorCode);
            }
        }

        return parent::render($request, $exception);
    }
}
