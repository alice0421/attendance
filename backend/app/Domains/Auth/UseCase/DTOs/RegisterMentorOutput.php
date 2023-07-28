<?php

declare(strict_types=1);

namespace App\Domains\Auth\UseCase\DTOs;

use App\Domains\Auth\Domain\Entities\RegisterMentorOutputEntity;

/**
 * メンター登録の入力
 */
class RegisterMentorOutput
{
    /**
     * @var string
     */
    private string $code;

    /**
     * @var string
     */
    private string $email;

    /**
     * @var string
     */
    private string $name;

    /**
     * @param string $code
     * @param string $email
     * @param string $name
     */
    public function __construct(string $code, string $email, string $name)
    {
        $this->code = $code;
        $this->email = $email;
        $this->name = $name;
    }

    /**
     * @param Mentor $mentor
     * @return self
     */
    public static function createFromEntity(RegisterMentorOutputEntity $entity): self
    {
        return new self(
            $entity->getCode()->value(),
            $entity->getEmail()->value(),
            $entity->getName()->value()
        );
    }

    /**
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
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
}
