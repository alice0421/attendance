<?php

declare(strict_types=1);

namespace App\Domains\Auth\UseCase\DTOs;

use App\Domains\Auth\Domain\Entities\MentorLoginInputEntity;
use App\Domains\Auth\Domain\ValueObjects\MentorEmailVO;
use App\Domains\Auth\Domain\ValueObjects\MentorPasswordVO;

/**
 * メンターログインの入力
 */
class MentorLoginInput
{
    /**
     * @var string
     */
    private string $email;

    /**
     * @var string
     */
    private string $password;

    /**
     * @param string $email
     * @param string $password
     */
    public function __construct(string $email, string $password)
    {
        $this->email = $email;
        $this->password = $password;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @return MentorLoginInputEntity
     */
    public function toEntity(): MentorLoginInputEntity
    {
        return new MentorLoginInputEntity(
            MentorEmailVO::create($this->getEmail()),
            MentorPasswordVO::create($this->getPassword()),
        );
    }
}
