<?php

namespace App\Services;

use Symfony\Component\HttpFoundation\Response;

class TransaccionCompletaDeferred13Service
{
    protected TbkApiClient $apiClient;
    protected string $baseUrlProd = 'https://webpay3g.transbank.cl';
    protected string $baseUrlIntg = 'https://webpay3gint.transbank.cl';
    protected string $basePath = 'rswebpaytransaction/api/webpay/v1.3/transactions';

    public function __construct(string $apiKeyId, string $apiKeySecret)
    {
        $this->apiClient = new TbkApiClient($apiKeyId, $apiKeySecret);
    }

    private function getBaseUrl(): string
    {
        return app()->environment('production') ? $this->baseUrlProd : $this->baseUrlIntg;
    }

    public function createTransaction(array $payload): array
    {
        return $this->request('POST', $this->basePath, $payload, 'creating');
    }

    public function installments(string $token, array $payload): array
    {
        return $this->request('POST', $this->basePath . '/' . $token . '/installments', $payload, 'requesting installments for');
    }

    public function commit(string $token, array $payload): array
    {
        return $this->request('PUT', $this->basePath . '/' . $token, $payload, 'committing');
    }

    public function capture(string $token, array $payload): array
    {
        return $this->request('PUT', $this->basePath . '/' . $token . '/capture', $payload, 'capturing');
    }

    public function status(string $token): array
    {
        return $this->request('GET', $this->basePath . '/' . $token, [], 'getting status for');
    }

    public function refund(string $token, array $payload): array
    {
        return $this->request('POST', $this->basePath . '/' . $token . '/refunds', $payload, 'refunding');
    }

    private function request(string $method, string $endpoint, array $payload, string $action): array
    {
        $response = $this->apiClient->request($method, $this->getBaseUrl(), $endpoint, $payload);

        if ($response['status'] !== Response::HTTP_OK) {
            throw new \Exception(
                'Error ' . $action . ' Transacción Completa Diferida 1.3: ' . json_encode([
                    'status' => $response['status'],
                    'url' => $response['url'] ?? null,
                    'payload' => $response['payload'] ?? $payload,
                    'response' => $response['response'],
                    'raw_response' => $response['raw_response'] ?? null,
                ]),
                $response['status']
            );
        }

        return $response['response'];
    }
}
