<?php

declare(strict_types=1);

namespace App\Domains\Auth\UseCase\DTOs;

use App\Domains\Auth\Domain\Entities\StaffRegisterInputEntity;
use App\Domains\Auth\Domain\ValueObjects\StaffEmailVO;
use App\Domains\Auth\Domain\ValueObjects\StaffNameVO;
use App\Domains\Auth\Domain\ValueObjects\StaffPasswordVO;

/**
 * メンター登録の入力
 */
class StaffRegisterInput
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
     * @return StaffRegisterInputEntity
     */
    public function toEntity(): StaffRegisterInputEntity
    {
        return new StaffRegisterInputEntity(
            StaffEmailVO::create($this->email),
            StaffNameVO::create($this->name),
            StaffPasswordVO::create($this->password)
        );
    }
}
