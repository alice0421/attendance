<?php

declare(strict_types=1);

namespace App\Domains\Auth\UseCase;

use App\Domains\Auth\Domain\Repositories\AuthRepository;
use App\Domains\Auth\UseCase\DTOs\MentorLoginInput;
use App\Domains\Auth\UseCase\DTOs\MentorLoginOutput;

class MentorLoginUseCase
{
    private AuthRepository $authRepository;

    /**
     * @param AuthRepository $authRepository
     */
    public function __construct(AuthRepository $authRepository)
    {
        $this->authRepository = $authRepository;
    }

    /**
     * @param MentorLoginInput $mentorLoginInput
     * @return MentorLoginOutput
     */
    public function execute(MentorLoginInput $mentorLoginInput): MentorLoginOutput
    {
        $mentorLoginOutputEntity = $this->authRepository->mentorLogin($mentorLoginInput->toEntity());

        return MentorLoginOutput::createFromEntity($mentorLoginOutputEntity);
    }
}
