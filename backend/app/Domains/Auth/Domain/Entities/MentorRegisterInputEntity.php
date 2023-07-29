<?php

declare(strict_types=1);

namespace App\Domains\Auth\Domain\Entities;

use App\Domains\Auth\Domain\ValueObjects\MentorEmailVO;
use App\Domains\Auth\Domain\ValueObjects\MentorNameVO;
use App\Domains\Auth\Domain\ValueObjects\MentorPasswordVO;

/**
 * メンター登録の入力Entity
 */
class MentorRegisterInputEntity
{
    /**
     * @var MentorEmailVO
     */
    private MentorEmailVO $email;

    /**
     * @var MentorNameVO
     */
    private MentorNameVO $name;

    /**
     * @var MentorPasswordVO
     */
    private MentorPasswordVO $password;

    /**
     * @param MentorEmailVO $email
     * @param MentorNameVO $name
     * @param MentorPasswordVO $password
     */
    public function __construct(MentorEmailVO $email, MentorNameVO $name, MentorPasswordVO $password)
    {
        $this->email = $email;
        $this->name = $name;
        $this->password = $password;
    }

    /**
     * @return MentorEmailVO
     */
    public function getEmail(): MentorEmailVO
    {
        return $this->email;
    }

    /**
     * @return MentorNameVO
     */
    public function getName(): MentorNameVO
    {
        return $this->name;
    }

    /**
     * @return MentorPasswordVO
     */
    public function getPassword(): MentorPasswordVO
    {
        return $this->password;
    }
}
