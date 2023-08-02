<?php

declare(strict_types=1);

namespace App\Domains\Auth\Domain\Repositories;

use App\Domains\Auth\Domain\Entities\MentorLoginInputEntity;
use App\Domains\Auth\Domain\Entities\MentorLoginOutputEntity;
use App\Domains\Auth\Domain\Entities\MentorRegisterInputEntity;
use App\Domains\Auth\Domain\Entities\MentorRegisterOutputEntity;
use App\Domains\Auth\Domain\Entities\StaffRegisterInputEntity;
use App\Domains\Auth\Domain\Entities\StaffRegisterOutputEntity;

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

    /**
     * @param MentorLoginInputEntity $mentorLoginInputEntity
     * @return MentorLoginOutputEntity
     */
    public function mentorLogin(MentorLoginInputEntity $mentorLoginInputEntity): MentorLoginOutputEntity;

    /**
     * @param StaffRegisterInputEntity $staffRegisterInputEntity
     * @return StaffRegisterOutputEntity
     */
    public function staffRegister(StaffRegisterInputEntity $staffRegisterInputEntity): StaffRegisterOutputEntity;

}
