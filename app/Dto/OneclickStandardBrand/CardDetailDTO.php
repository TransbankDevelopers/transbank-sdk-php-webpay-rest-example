<?php

namespace App\Dto\OneclickStandardBrand;


class CardDetailDTO
{
    /** @var string */
    private $cardNumber;

    public function __construct(string $cardNumber)
    {
        $this->cardNumber = $cardNumber;
    }

    public static function fromArray(array $data): self
    {
        return new self($data['card_number']);
    }

    public function getCardNumber(): string
    {
        return $this->cardNumber;
    }
}
