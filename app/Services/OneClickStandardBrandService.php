<?php

namespace App\Services;

use App\Dto\OneclickStandardBrand\ChallengeResponseDTO;
use App\Dto\OneclickStandardBrand\AuthorizeResponseDTO;
use Symfony\Component\HttpFoundation\Response;

class OneClickStandardBrandService
{
    protected TbkApiClient $apiClient;
    protected string $baseUrl = "https://webpay3g.transbank.cl";

    public function __construct(string $apiKeyId, string $apiKeySecret)
    {
        $this->apiClient = new TbkApiClient($apiKeyId, $apiKeySecret);
    }

    public function startInscription(
        string $userName,
        string $email,
        string $responseUrl
    ) {
        $payload = [
            'username'      => $userName,
            'email'         => $email,
            'response_url'  => $responseUrl,
        ];
        $endpoint = 'rswebpaytransaction/api/oneclick/v1.4/inscriptions';
        $response = $this->apiClient->request('POST', $this->baseUrl, $endpoint, $payload);
        if ($response['status'] !== Response::HTTP_OK) {
            throw new \Exception('Error starting Oneclick brand inscription: ' . json_encode($response['response']), $response['status']);
        }
        return $response['response'];
    }

    public function finishInscription(string $token)
    {
        $endpoint = 'rswebpaytransaction/api/oneclick/v1.4/inscriptions/' . $token;
        $response = $this->apiClient->request('PUT', $this->baseUrl, $endpoint, []);
        if ($response['status'] !== Response::HTTP_OK) {
            throw new \Exception('Error finishing Oneclick brand inscription: ' . json_encode($response['response']), $response['status']);
        }
        return $response['response'];
    }

    public function deleteInscription(string $tbkUser, string $username)
    {
        $endpoint = 'rswebpaytransaction/api/oneclick/v1.4/inscriptions/';
        $response = $this->apiClient->request('DELETE', $this->baseUrl, $endpoint, [
            'tbk_user' => $tbkUser,
            'username' => $username
        ]);
        if ($response['status'] !== Response::HTTP_NO_CONTENT) {
            throw new \Exception('Error deleting Oneclick brand inscription: ' . json_encode($response['response']), $response['status']);
        }
        return $response['response'];
    }


    /**
     * @return ChallengeResponseDTO|AuthorizeResponseDTO
     */
    public function authorize(
        string $userName,
        string $tbkUser,
        string $buyOrder,
        int $posEntryMode,
        string $request3dsAuth,
        array $details
    ) {
        $payload = [
            'username'                      => $userName,
            'tbk_user'                      => $tbkUser,
            'buy_order'                     => $buyOrder,
            'pos_entry_mode'                => $posEntryMode,
            'request_3ds_authentication'    => $request3dsAuth,
            'Details'                       => $details,
        ];
        $endpoint = 'rswebpaytransaction/api/oneclick/v1.4/transactions';
        $response = $this->apiClient->request('POST', $this->baseUrl, $endpoint, $payload);
        if ($response['status'] !== Response::HTTP_OK) {
            throw new \Exception('Error authorizing Oneclick brand transaction: ' . json_encode($response['response']), $response['status']);
        }
        if (isset($response['response']['challenge_data']))
            return ChallengeResponseDTO::fromArray($response['response']);

        return AuthorizeResponseDTO::fromArray($response['response']);
    }

    public function status(string $buyOrder)
    {
        $endpoint = 'rswebpaytransaction/api/oneclick/v1.4/transactions/' . $buyOrder;
        $response = $this->apiClient->request('GET', $this->baseUrl, $endpoint, []);
        if ($response['status'] !== Response::HTTP_OK) {
            throw new \Exception('Error getting Oneclick brand transaction status: ' . json_encode($response['response']), $response['status']);
        }
        return $response['response'];
    }

    public function refund(string $buyOrder, string $commerceCode, string $detailBuyOrder, int $amount)
    {
        $endpoint = 'rswebpaytransaction/api/oneclick/v1.4/transaction/' . $buyOrder . '/refund';
        $payload = [
            'commerce_code' => $commerceCode,
            'detail_buy_order' => $detailBuyOrder,
            'amount'    => $amount,
        ];
        $response = $this->apiClient->request('POST', $this->baseUrl, $endpoint, $payload);
        if ($response['status'] !== Response::HTTP_OK) {
            throw new \Exception('Error refunding Oneclick brand transaction: ' . json_encode($response['response']), $response['status']);
        }
        return $response['response'];
    }
}
