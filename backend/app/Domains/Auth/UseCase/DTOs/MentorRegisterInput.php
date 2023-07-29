<?php

declare(strict_types=1);

namespace App\Domains\Auth\UseCase\DTOs;

use App\Domains\Auth\Domain\Entities\MentorRegisterInputEntity;
use App\Domains\Auth\Domain\ValueObjects\MentorEmailVO;
use App\Domains\Auth\Domain\ValueObjects\MentorNameVO;
use App\Domains\Auth\Domain\ValueObjects\MentorPasswordVO;

/**
 * メンター登録の入力
 */
class MentorRegisterInput
{
    /**
     * @var string
     */
    private string $email;

    /**
     * @var string
     */
    private string $name;

    /**
     * @var string
     */
    private string $password;

    /**
     * @param string $email
     * @param string $name
     * @param string $password
     */
    public function __construct(string $email, string $name, string $password)
    {
        $this->email = $email;
        $this->name = $name;
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
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @return MentorRegisterInputEntity
     */
    public function toEntity(): MentorRegisterInputEntity
    {
        return new MentorRegisterInputEntity(
            MentorEmailVO::create($this->email),
            MentorNameVO::create($this->name),
            MentorPasswordVO::create($this->password)
        );
    }
}
