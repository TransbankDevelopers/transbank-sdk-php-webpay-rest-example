<?php

namespace App\Exceptions;

use App\Support\ExceptionViewData;
use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Transbank\Webpay\Exceptions\TransbankException;
use Transbank\Webpay\Exceptions\WebpayException;

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
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        // Errores del SDK de Transbank (Webpay Plus, Oneclick, Transacción Completa, Patpass):
        // en esta app de prueba se muestran completos en una pantalla legible, también en producción.
        if (($exception instanceof WebpayException || $exception instanceof TransbankException) && !$request->expectsJson()) {
            $data = ExceptionViewData::from($exception, [
                'action' => $request->method() . ' /' . ltrim($request->path(), '/'),
                'req' => $request->except(['_token', '_method']),
            ]);

            return response()->view('errors/exception', $data, $data['status']);
        }

        return parent::render($request, $exception);
    }
}
