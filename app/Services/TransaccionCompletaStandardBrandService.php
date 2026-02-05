<?php

namespace App\Services;

use Symfony\Component\HttpFoundation\Response;

class TransaccionCompletaStandardBrandService
{
    protected TbkApiClient $apiClient;
    protected string $baseUrl = 'https://webpay3g.transbank.cl';
    protected string $basePath = 'rswebpaytransaction/api/webpay/v1.4/transactions';

    public function __construct(string $apiKeyId, string $apiKeySecret)
    {
        $this->apiClient = new TbkApiClient($apiKeyId, $apiKeySecret);
    }

    public function createTransaction(array $payload): array
    {
        $endpoint = $this->basePath;
        $response = $this->apiClient->request('POST', $this->baseUrl, $endpoint, $payload);

        if ($response['status'] !== Response::HTTP_OK) {
            throw new \Exception('Error creating Transacción Completa Estándar Marca: ' . json_encode($response['response']), $response['status']);
        }

        return $response['response'];
    }

    public function installments(string $token, array $payload): array
    {
        $endpoint = $this->basePath . '/' . $token . '/installments';
        $response = $this->apiClient->request('POST', $this->baseUrl, $endpoint, $payload);

        if ($response['status'] !== Response::HTTP_OK) {
            throw new \Exception('Error requesting installments for Transacción Completa Estándar Marca: ' . json_encode($response['response']), $response['status']);
        }

        return $response['response'];
    }

    public function commit(string $token, array $payload): array
    {
        $endpoint = $this->basePath . '/' . $token;
        $response = $this->apiClient->request('PUT', $this->baseUrl, $endpoint, $payload);

        if ($response['status'] !== Response::HTTP_OK) {
            throw new \Exception('Error committing Transacción Completa Estándar Marca: ' . json_encode($response['response']), $response['status']);
        }

        return $response['response'];
    }

    public function status(string $token): array
    {
        $endpoint = $this->basePath . '/' . $token;
        $response = $this->apiClient->request('GET', $this->baseUrl, $endpoint, []);

        if ($response['status'] !== Response::HTTP_OK) {
            throw new \Exception('Error getting status for Transacción Completa Estándar Marca: ' . json_encode($response['response']), $response['status']);
        }

        return $response['response'];
    }

    public function refund(string $token, array $payload): array
    {
        $endpoint = $this->basePath . '/' . $token . '/refunds';
        $response = $this->apiClient->request('POST', $this->baseUrl, $endpoint, $payload);

        if ($response['status'] !== Response::HTTP_OK) {
            throw new \Exception('Error refunding Transacción Completa Estándar Marca: ' . json_encode($response['response']), $response['status']);
        }

        return $response['response'];
    }

    public function accountVerify(array $payload): array
    {
        $endpoint = 'rswebpaytransaction/api/webpay/v1.4/account-verify';
        $response = $this->apiClient->request('POST', $this->baseUrl, $endpoint, $payload);

        if ($response['status'] !== Response::HTTP_OK) {
            throw new \Exception('Error verifying account for Transacción Completa Estándar Marca: ' . json_encode($response['response']), $response['status']);
        }

        return $response['response'];
    }
}
