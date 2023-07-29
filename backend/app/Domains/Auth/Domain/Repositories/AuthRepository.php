<?php

declare(strict_types=1);

namespace App\Domains\Auth\Domain\Repositories;

use App\Domains\Auth\Domain\Entities\MentorRegisterInputEntity;
use App\Domains\Auth\Domain\Entities\MentorRegisterOutputEntity;

/**
 * 認証系のインターフェース
 */
interface AuthRepository
{
    /**
     * @param MentorRegisterInputEntity $mentorRegisterInputEntity
     * @return MentorRegisterOutputEntity
     */
    public function mentorRegister(MentorRegisterInputEntity $mentorRegisterInputEntity): MentorRegisterOutputEntity;
}
