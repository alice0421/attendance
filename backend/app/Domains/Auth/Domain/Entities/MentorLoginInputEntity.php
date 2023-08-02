<?php

declare(strict_types=1);

namespace App\Domains\Auth\Domain\Entities;

use App\Domains\Auth\Domain\ValueObjects\MentorEmailVO;
use App\Domains\Auth\Domain\ValueObjects\MentorPasswordVO;

/**
 * メンターログインの入力Entity
 */
class MentorLoginInputEntity
{
    /**
     * @var MentorEmailVO
     */
    private MentorEmailVO $email;

    /**
     * @var MentorPasswordVO
     */
    private MentorPasswordVO $password;

    /**
     * @param MentorEmailVO $email
     * @param MentorPasswordVO $password
     */
    public function __construct(MentorEmailVO $email, MentorPasswordVO $password)
    {
        $this->email = $email;
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
     * @return MentorPasswordVO
     */
    public function getPassword(): MentorPasswordVO
    {
        return $this->password;
    }

    /**
    * @return array<string>
    */
    public function toArray(): array
    {
        return [
            'email' => $this->getEmail()->value(),
            'password' => $this->getPassword()->value(),
        ];
    }
}
