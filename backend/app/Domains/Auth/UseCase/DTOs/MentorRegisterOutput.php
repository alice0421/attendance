<?php

declare(strict_types=1);

namespace App\Domains\Auth\UseCase\DTOs;

use App\Domains\Auth\Domain\Entities\MentorRegisterOutputEntity;

/**
 * メンター登録の入力
 */
class MentorRegisterOutput
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
     * @var int
     */
    private int $id;

    /**
     * @var string
     */
    private string $name;

    /**
     * @param string $code
     * @param string $email
     * @param int $id
     * @param string $name
     */
    public function __construct(string $code, string $email, int $id, string $name)
    {
        $this->code = $code;
        $this->email = $email;
        $this->id = $id;
        $this->name = $name;
    }

    /**
     * @param Mentor $mentor
     * @return self
     */
    public static function createFromEntity(MentorRegisterOutputEntity $entity): self
    {
        return new self(
            $entity->getCode()->value(),
            $entity->getEmail()->value(),
            $entity->getId()->value(),
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
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }
}
