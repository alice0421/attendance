<?php

declare(strict_types=1);

namespace App\Domains\Auth\UseCase;

use App\Domains\Auth\Domain\Repositories\AuthRepository;
use App\Domains\Auth\UseCase\DTOs\RegisterMentorInput;
use App\Domains\Auth\UseCase\DTOs\RegisterMentorOutput;

class RegisterMentorUseCase
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
     * @param RegisterMentorInput $registerMentorInput
     * @return RegisterMentorOutput
     */
    public function execute(RegisterMentorInput $registerMentorInput): RegisterMentorOutput
    {
        $registerMentorOutputEntity = $this->authRepository->registerMentor($registerMentorInput->toEntity());

        return RegisterMentorOutput::createFromEntity($registerMentorOutputEntity);
    }
}
