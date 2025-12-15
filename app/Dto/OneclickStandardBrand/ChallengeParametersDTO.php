<?php

namespace App\Dto\OneclickStandardBrand;

class ChallengeParametersDTO
{
    /** @var string */
    private $browserChallengeToken;

    public function __construct(string $browserChallengeToken)
    {
        $this->browserChallengeToken = $browserChallengeToken;
    }

    public static function fromArray(array $data): self
    {
        return new self($data['browserChallengeToken']);
    }

    public function getBrowserChallengeToken(): string
    {
        return $this->browserChallengeToken;
    }
}
