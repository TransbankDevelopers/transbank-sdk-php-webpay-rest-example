<?php

namespace App\Dto\OneclickStandardBrand;


class TransactionDetailsDTO
{
    /** @var int|float */
    private $amount;

    /** @var string */
    private $status;

    /** @var string|null */
    private $glosa;

    /** @var string|null */
    private $responseCodeReference;

    /** @var string */
    private $tid;

    /** @var string */
    private $authorizationCode;

    /** @var string */
    private $paymentTypeCode;

    /** @var int */
    private $installmentsNumber;

    /** @var string */
    private $commerceCode;

    /** @var string */
    private $buyOrder;

    /** @var string */
    private $recurPmnt;

    /** @var string */
    private $eciTrxRes;

    /** @var string */
    private $pmntInd;

    public function __construct(
        $amount,
        string $status,
        ?string $glosa,
        ?string $responseCodeReference,
        string $tid,
        string $authorizationCode,
        string $paymentTypeCode,
        int $installmentsNumber,
        string $commerceCode,
        string $buyOrder,
        string $recurPmnt,
        string $eciTrxRes,
        string $pmntInd
    ) {
        $this->amount = $amount;
        $this->status = $status;
        $this->glosa = $glosa;
        $this->responseCodeReference = $responseCodeReference;
        $this->tid = $tid;
        $this->authorizationCode = $authorizationCode;
        $this->paymentTypeCode = $paymentTypeCode;
        $this->installmentsNumber = $installmentsNumber;
        $this->commerceCode = $commerceCode;
        $this->buyOrder = $buyOrder;
        $this->recurPmnt = $recurPmnt;
        $this->eciTrxRes = $eciTrxRes;
        $this->pmntInd = $pmntInd;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['amount'],
            $data['status'],
            $data['glosa'] ?? null,
            $data['response_code_reference'] ?? null,
            $data['tid'],
            $data['authorization_code'],
            $data['payment_type_code'],
            $data['installments_number'],
            $data['commerce_code'],
            $data['buy_order'],
            $data['recur_pmnt'] ?? '',
            $data['eci_trx_res'] ?? '',
            $data['pmnt_ind'] ?? ''
        );
    }

    public function getAmount()
    {
        return $this->amount;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function getGlosa(): ?string
    {
        return $this->glosa;
    }

    public function getResponseCodeReference(): ?string
    {
        return $this->responseCodeReference;
    }

    public function getTid(): string
    {
        return $this->tid;
    }

    public function getAuthorizationCode(): string
    {
        return $this->authorizationCode;
    }

    public function getPaymentTypeCode(): string
    {
        return $this->paymentTypeCode;
    }

    public function getInstallmentsNumber(): int
    {
        return $this->installmentsNumber;
    }

    public function getCommerceCode(): string
    {
        return $this->commerceCode;
    }

    public function getBuyOrder(): string
    {
        return $this->buyOrder;
    }

    public function getRecurPmnt(): string
    {
        return $this->recurPmnt;
    }

    public function getEciTrxRes(): string
    {
        return $this->eciTrxRes;
    }

    public function getPmntInd(): string
    {
        return $this->pmntInd;
    }
}
