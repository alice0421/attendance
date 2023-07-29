<?php

declare(strict_types=1);

namespace App\Domains\Auth\Infrastructure\Repositories;

use App\Domains\Auth\Domain\Entities\MentorRegisterInputEntity;
use App\Domains\Auth\Domain\Entities\MentorRegisterOutputEntity;
use App\Domains\Auth\Domain\Repositories\AuthRepository as AuthRepositoryInterface;
use App\Models\Mentor;
use Illuminate\Support\Facades\Hash;

/**
 * 認証系の実装クラス
 */
class AuthRepository implements AuthRepositoryInterface
{
    /**
     * @param MentorRegisterInputEntity $mentorRegisterInputEntity
     * @return MentorRegisterOutputEntity
     */
    public function mentorRegister(MentorRegisterInputEntity $mentorRegisterInputEntity): MentorRegisterOutputEntity
    {
        // codeを一意に定める
        while(true){
            $code = 'm'. (string) str_pad((string) random_int(0, 999999), 6, "0", STR_PAD_LEFT);
            if(!Mentor::where('code', $code)->exists()) break;
        }
        
        $mentor = Mentor::create([
            'code' => $code,
            'name' => $mentorRegisterInputEntity->getName()->value(),
            'is_admin' => false,
            'is_remote' => false,
            'work_day' => 0,
            'state' => 0,
            'email' => $mentorRegisterInputEntity->getEmail()->value(),
            'password' => Hash::make($mentorRegisterInputEntity->getPassword()->value()),
        ]);

        return MentorRegisterOutputEntity::createFromModel($mentor);
    }
}
