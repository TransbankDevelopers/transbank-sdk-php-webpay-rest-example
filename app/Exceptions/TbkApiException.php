<?php

namespace App\Exceptions;

/**
 * Error de una llamada a la API de Transbank hecha con App\Services\TbkApiClient
 * (productos que no usan el SDK: Oneclick y Transacción Completa Estándar Marca, Diferida 1.3).
 *
 * Mantiene el mensaje y el código que lanzaban los servicios con \Exception, y además guarda
 * la petición enviada para mostrarla en la pantalla de error. No guarda headers: llevan la API key.
 */
class TbkApiException extends \Exception
{
    private ?array $request;

    public function __construct(string $message, int $code = 0, ?array $request = null, ?\Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
        $this->request = $request;
    }

    /**
     * @param array $response Respuesta de TbkApiClient::request() (incluye method, url, payload y status).
     */
    public static function fromResponse(string $message, array $response): self
    {
        return new self($message, (int) ($response['status'] ?? 0), [
            'method' => $response['method'] ?? null,
            'url' => $response['url'] ?? null,
            'payload' => $response['payload'] ?? [],
        ]);
    }

    /**
     * @return array{method: ?string, url: ?string, payload: array}|null
     */
    public function getRequest(): ?array
    {
        return $this->request;
    }
}
