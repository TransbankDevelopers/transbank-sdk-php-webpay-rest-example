<?php

namespace App\Exceptions;

use App\Support\ExceptionViewData;
use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;
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
        // En esta app de prueba los errores se muestran con su mensaje en una pantalla legible,
        // también en producción: los de Transbank (SDK o TbkApiClient) y cualquier error inesperado.
        if (!$request->expectsJson() && $this->rendersErrorPage($exception)) {
            $data = ExceptionViewData::from($exception, [
                'action' => $request->method() . ' /' . ltrim($request->path(), '/'),
                'req' => $request->except(['_token', '_method']),
            ]);

            return response()->view('errors/exception', $data, $data['status']);
        }

        return parent::render($request, $exception);
    }

    /**
     * Laravel ya resuelve bien estos casos con su flujo normal: la validación vuelve al formulario,
     * la autenticación redirige al login y los errores HTTP (404, 419...) usan las vistas errors/{código}.
     */
    private function rendersErrorPage(Exception $exception): bool
    {
        if ($exception instanceof WebpayException
            || $exception instanceof TransbankException
            || $exception instanceof TbkApiException) {
            return true;
        }

        if ($exception instanceof Responsable || method_exists($exception, 'render')) {
            return false;
        }

        $prepared = $this->prepareException($exception);

        return !$this->isHttpException($prepared)
            && !$prepared instanceof ValidationException
            && !$prepared instanceof AuthenticationException
            && !$prepared instanceof HttpResponseException;
    }
}
