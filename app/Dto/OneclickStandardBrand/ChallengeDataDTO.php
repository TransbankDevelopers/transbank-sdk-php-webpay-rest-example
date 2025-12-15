<?php

namespace App\Dto\OneclickStandardBrand;

class ChallengeDataDTO
{
    /** @var string */
    private $baseUrl;

    /** @var string */
    private $timeout;

    /** @var string */
    private $redirectMethod;

    /** @var string */
    private $targetType;

    /** @var ChallengeParametersDTO */
    private $parameters;

    public function __construct(
        string $baseUrl,
        string $timeout,
        string $redirectMethod,
        string $targetType,
        ChallengeParametersDTO $parameters
    ) {
        $this->baseUrl = $baseUrl;
        $this->timeout = $timeout;
        $this->redirectMethod = $redirectMethod;
        $this->targetType = $targetType;
        $this->parameters = $parameters;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['base_url'],
            $data['timeout'],
            $data['redirect_method'],
            $data['target_type'],
            ChallengeParametersDTO::fromArray($data['parameters'])
        );
    }

    public function getBaseUrl(): string
    {
        return $this->baseUrl;
    }

    public function getTimeout(): string
    {
        return $this->timeout;
    }

    public function getRedirectMethod(): string
    {
        return $this->redirectMethod;
    }

    public function getTargetType(): string
    {
        return $this->targetType;
    }

    public function getParameters(): ChallengeParametersDTO
    {
        return $this->parameters;
    }
}
