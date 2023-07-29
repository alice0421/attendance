<?php

declare(strict_types=1);

namespace App\Domains\Auth\UseCase;

use App\Domains\Auth\Domain\Repositories\AuthRepository;
use App\Domains\Auth\UseCase\DTOs\MentorRegisterInput;
use App\Domains\Auth\UseCase\DTOs\MentorRegisterOutput;

class MentorRegisterUseCase
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
     * @param MentorRegisterInput $mentorRegisterInput
     * @return MentorRegisterOutput
     */
    public function execute(MentorRegisterInput $mentorRegisterInput): MentorRegisterOutput
    {
        $mentorRegisterOutputEntity = $this->authRepository->mentorRegister($mentorRegisterInput->toEntity());

        return MentorRegisterOutput::createFromEntity($mentorRegisterOutputEntity);
    }
}
