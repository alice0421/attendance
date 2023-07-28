<?php

declare(strict_types=1);

namespace App\Domains\Auth\Domain\Repositories;

use App\Domains\Auth\Domain\Entities\RegisterMentorInputEntity;
use App\Domains\Auth\Domain\Entities\RegisterMentorOutputEntity;

/**
 * 認証系のインターフェース
 */
interface AuthRepository
{
    /**
     * @param RegisterMentorInputEntity $registerMentorInputEntity
     * @return RegisterMentorOutputEntity
     */
    public function registerMentor(RegisterMentorInputEntity $registerMentorInputEntity): RegisterMentorOutputEntity;
}
