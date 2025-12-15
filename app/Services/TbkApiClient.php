<?php

namespace App\Services;

class TbkApiClient
{
    protected string $apiKeyId;
    protected string $apiKeySecret;

    public function __construct(string $apiKeyId, string $apiKeySecret)
    {
        $this->apiKeyId     = $apiKeyId;
        $this->apiKeySecret = $apiKeySecret;
    }

    public function request(string $method, string $baseUrl, string $endpoint, array $payload = []): array
    {
        $url = rtrim($baseUrl, '/') . '/' . ltrim($endpoint, '/');

        $method = strtoupper($method);

        $headers = [
            'Content-Type: application/json',
            'Accept: application/json',
            'Tbk-Api-Key-Id: ' . $this->apiKeyId,
            'Tbk-Api-Key-Secret: ' . $this->apiKeySecret,
        ];

        $ch = curl_init();

        $options = [
            CURLOPT_URL            => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER     => $headers,
            CURLOPT_TIMEOUT        => 10,
            CURLOPT_CUSTOMREQUEST  => $method,
        ];

        if (in_array($method, ['POST', 'PUT', 'PATCH', 'DELETE'])) {
            $options[CURLOPT_POSTFIELDS] = json_encode($payload);
        }

        curl_setopt_array($ch, $options);

        $rawResponse = curl_exec($ch);

        if (curl_errno($ch)) {
            throw new \Exception('cURL error: ' . curl_error($ch));
        }

        $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        return [
            'status'   => $status,
            'response' => json_decode($rawResponse, true),
        ];
    }
}
