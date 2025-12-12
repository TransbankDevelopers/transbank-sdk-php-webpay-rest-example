<?php

namespace App\Dto;

class AuthorizeResponseDTO
{
    /** @var string */
    private $buyOrder;
    
    /** @var CardDetailDTO */
    private $cardDetail;
    
    /** @var string */
    private $accountingDate;
    
    /** @var string */
    private $transactionDate;
    
    /** @var string */
    private $request3dsAuthentication;
    
    /** @var TransactionDetailsDTO */
    private $details;

    public function __construct(
        string $buyOrder,
        CardDetailDTO $cardDetail,
        string $accountingDate,
        string $transactionDate,
        string $request3dsAuthentication,
        TransactionDetailsDTO $details
    ) {
        $this->buyOrder = $buyOrder;
        $this->cardDetail = $cardDetail;
        $this->accountingDate = $accountingDate;
        $this->transactionDate = $transactionDate;
        $this->request3dsAuthentication = $request3dsAuthentication;
        $this->details = $details;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['buy_order'],
            CardDetailDTO::fromArray($data['card_detail']),
            $data['accounting_date'],
            $data['transaction_date'],
            $data['request_3ds_authentication'],
            TransactionDetailsDTO::fromArray($data['Details'])
        );
    }

    public function getBuyOrder(): string
    {
        return $this->buyOrder;
    }

    public function getCardDetail(): CardDetailDTO
    {
        return $this->cardDetail;
    }

    public function getAccountingDate(): string
    {
        return $this->accountingDate;
    }

    public function getTransactionDate(): string
    {
        return $this->transactionDate;
    }

    public function getRequest3dsAuthentication(): string
    {
        return $this->request3dsAuthentication;
    }

    public function getDetails(): TransactionDetailsDTO
    {
        return $this->details;
    }
}
