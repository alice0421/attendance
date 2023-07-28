<?php

declare(strict_types=1);

namespace App\Domains\Auth\Infrastructure\Repositories;

use App\Domains\Auth\Domain\Entities\RegisterMentorInputEntity;
use App\Domains\Auth\Domain\Entities\RegisterMentorOutputEntity;
use App\Domains\Auth\Domain\Repositories\AuthRepository as AuthRepositoryInterface;
use App\Models\Mentor;
use Illuminate\Support\Facades\Hash;

/**
 * 認証系の実装クラス
 */
class AuthRepository implements AuthRepositoryInterface
{
    /**
     * @param RegisterMentorInputEntity $registerMentorInputEntity
     * @return RegisterMentorOutputEntity
     */
    public function registerMentor(RegisterMentorInputEntity $registerMentorInputEntity): RegisterMentorOutputEntity
    {
        // codeを一意に定める
        while(true){
            $code = 'm'. (string) str_pad((string) random_int(0, 999999), 6, "0", STR_PAD_LEFT);
            if(!Mentor::where('code', $code)->exists()) break;
        }
        
        $mentor = Mentor::create([
            'code' => $code,
            'name' => $registerMentorInputEntity->getName()->value(),
            'is_admin' => true,
            'is_remote' => false,
            'work_day' => 0,
            'state' => 0,
            'email' => $registerMentorInputEntity->getEmail()->value(),
            'password' => Hash::make($registerMentorInputEntity->getPassword()->value()),
        ]);

        return RegisterMentorOutputEntity::createFromModel($mentor);
    }
}
