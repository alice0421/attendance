<?php

declare(strict_types=1);

namespace App\Domains\Auth\Domain\Entities;

use App\Domains\Auth\Domain\ValueObjects\StaffEmailVO;
use App\Domains\Auth\Domain\ValueObjects\StaffNameVO;
use App\Domains\Auth\Domain\ValueObjects\StaffPasswordVO;

/**
 * 運営登録の入力Entity
 */
class StaffRegisterInputEntity
{
    /**
     * @var StaffEmailVO
     */
    private StaffEmailVO $email;

    /**
     * @var StaffNameVO
     */
    private StaffNameVO $name;

    /**
     * @var StaffPasswordVO
     */
    private StaffPasswordVO $password;

    /**
     * @param StaffEmailVO $email
     * @param StaffNameVO $name
     * @param StaffPasswordVO $password
     */
    public function __construct(StaffEmailVO $email, StaffNameVO $name, StaffPasswordVO $password)
    {
        $this->email = $email;
        $this->name = $name;
        $this->password = $password;
    }

    /**
     * @return StaffEmailVO
     */
    public function getEmail(): StaffEmailVO
    {
        return $this->email;
    }

    /**
     * @return StaffNameVO
     */
    public function getName(): StaffNameVO
    {
        return $this->name;
    }

    /**
     * @return StaffPasswordVO
     */
    public function getPassword(): StaffPasswordVO
    {
        return $this->password;
    }
}
