<?php

declare(strict_types=1);

namespace App\Domains\Auth\UseCase;

use App\Domains\Auth\Domain\Repositories\AuthRepository;
use App\Domains\Auth\UseCase\DTOs\StaffRegisterInput;
use App\Domains\Auth\UseCase\DTOs\StaffRegisterOutput;

class StaffRegisterUseCase
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
     * @param StaffRegisterInput $staffRegisterInput
     * @return StaffRegisterOutput
     */
    public function execute(StaffRegisterInput $staffRegisterInput): StaffRegisterOutput
    {
        $staffRegisterOutputEntity = $this->authRepository->staffRegister($staffRegisterInput->toEntity());

        return StaffRegisterOutput::createFromEntity($staffRegisterOutputEntity);
    }
}
