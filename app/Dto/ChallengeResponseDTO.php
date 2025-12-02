<?php

namespace App\Dto;

class ChallengeResponseDTO
{

    
    /** @var ChallengeDataDTO */
    private $challengeData;

    public function __construct(ChallengeDataDTO $challengeData)
    {
        $this->challengeData = $challengeData;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            ChallengeDataDTO::fromArray($data['challenge_data'])
        );
    }

    public function getChallengeData(): ChallengeDataDTO
    {
        return $this->challengeData;
    }
}
