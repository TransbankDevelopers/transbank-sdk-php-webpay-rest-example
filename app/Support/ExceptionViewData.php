<?php

namespace App\Support;

use Throwable;
use Transbank\Webpay\Exceptions\WebpayRequestException;

/**
 * Arma los datos de la pantalla de error (errors/exception) a partir de una excepción.
 *
 * Es una app de prueba: el mensaje de la excepción se muestra tal cual, junto con la petición
 * a Transbank y los parámetros enviados. Los headers de la petición se omiten porque contienen
 * la API key del comercio.
 */
class ExceptionViewData
{
    public static function from(?Throwable $exception, array $context = []): array
    {
        $httpCode = $exception instanceof WebpayRequestException ? $exception->getHttpCode() : null;
        $code = $httpCode ?? ($context['status'] ?? ($exception ? $exception->getCode() : null));

        return [
            'title' => $context['title'] ?? 'No se pudo completar la operación',
            'action' => $context['action'] ?? null,
            'status' => self::httpStatus($code),
            'message' => $exception ? $exception->getMessage() : ($context['message'] ?? 'Error inesperado'),
            'failedRequest' => self::failedRequest($exception),
            'req' => $context['req'] ?? [],
        ];
    }

    /**
     * Código HTTP para la respuesta: el de Transbank si es válido, si no 500.
     */
    public static function httpStatus($code): int
    {
        $code = (int) $code;

        return $code >= 400 && $code <= 599 ? $code : 500;
    }

    private static function failedRequest(?Throwable $exception): ?array
    {
        if (!$exception instanceof WebpayRequestException || $exception->getFailedRequest() === null) {
            return null;
        }

        $request = $exception->getFailedRequest();

        return [
            'method' => $request->getMethod(),
            'url' => rtrim((string) $request->getBaseUrl(), '/') . '/' . ltrim((string) $request->getEndpoint(), '/'),
            'payload' => $request->getPayload(),
        ];
    }
}
