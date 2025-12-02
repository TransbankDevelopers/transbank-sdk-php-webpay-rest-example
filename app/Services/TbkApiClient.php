<?php

namespace App\Services;

class TbkApiClient
{
    protected string $apiKeyId;
    protected string $apiKeySecret;

    protected array $mockResponses = [
        'no_challenge_response' => [
                'status' => 200,
                'response' => [
                    'buy_order' => 'OrdenCompra',
                    'card_detail' => [
                        'card_number' => '123456****7890',
                    ],
                    'accounting_date' => '2024-10-01',
                    'transaction_date' => '2024-10-01T12:00:00Z',
                    'request_3ds_authentication' => 'YES',
                    'Details' => [
                        'amount' => 50,
                        'status' => 'AUTHORIZED',
                        'tid' => '123456789',
                        'authorization_code' => 'AuthCode123',
                        'payment_type_code' => 'VN',
                        'response_code' => 0,
                        'installments_number' => 0,
                        'commerce_code' => '597020000541',
                        'buy_order' => 'order12345',
                        'recur_pmnt' => 'V',
                        'eci_trx_res' => '7',
                        'pmnt_ind' => 'C',
                    ]
                ]
            ],
        'challenge_response' => [
                'status' => 200,
                'response' => [
                    'challenge_data' => [
                        'base_url' => 'https://mock-url.test',
                        'timeout' => '300',
                        'redirect_method' => 'POST',
                        'target_type' => 'REDIRECT_NO_BANK_IFRAME',
                        'parameters' => [
                            'browserChallengeToken' => 'MockToken123'
                        ]
                    ]
                ]
            ],
        'start_response' => [
                'status' => 200,
                'response' => [
                    'token' => 'MockToken1234567890',
                    'url_webpay' => 'https://mock-inscription-url.test/inscription'
                ]
            ]

    ];

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
