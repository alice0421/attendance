<?php

declare(strict_types=1);

namespace App\Domains\Auth\Domain\ValueObjects;

/**
 * メンターのパスワード
 */
class MentorPasswordVO
{
    /**
     * @var string
     */
    private string $_value;

    /**
     * @param string $password
     */
    private function __construct(string $password)
    {
        $this->_value = $password;
    }

    /**
     * @param string $password
     * @return self
     */
    public static function create(string $password): self
    {
        return new self($password);
    }

    /**
     * @return string
     */
    public function value(): string
    {
        return $this->_value;
    }

    /**
     * @param MentorPasswordVO $other
     * @return bool
     */
    public function equals(MentorPasswordVO $other): bool
    {
        return $this->_value === $other->value();
    }
}
