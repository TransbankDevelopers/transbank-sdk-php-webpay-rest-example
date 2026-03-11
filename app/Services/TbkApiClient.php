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
            'User-Agent: PostmanRuntime/7.51.1'
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
            $encodedPayload = $this->encodePayload($payload);
            $options[CURLOPT_POSTFIELDS] = $encodedPayload;
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
            'url' => $url,
            'payload' => $payload,
            'encoded_payload' => $encodedPayload ?? null,
            'raw_response' => $rawResponse,
            'response' => json_decode($rawResponse, true),
        ];
    }

    private function encodePayload(array $payload): string
    {
        if ($payload === []) {
            return '{}';
        }

        return json_encode($payload);
    }
}
