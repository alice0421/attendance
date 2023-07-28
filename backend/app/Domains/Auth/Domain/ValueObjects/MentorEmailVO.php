<?php

declare(strict_types=1);

namespace App\Domains\Auth\Domain\ValueObjects;

/**
 * メンターのemail
 */
class MentorEmailVO
{
    /**
     * @var string
     */
    private string $_value;

    /**
     * @param string $email
     */
    private function __construct(string $email)
    {
        $this->_value = $email;
    }

    /**
     * @param string $email
     * @return self
     */
    public static function create(string $email): self
    {
        return new self($email);
    }

    /**
     * @return string
     */
    public function value(): string
    {
        return $this->_value;
    }

    /**
     * @param MentorEmailVO $other
     * @return bool
     */
    public function equals(MentorEmailVO $other): bool
    {
        return $this->_value === $other->value();
    }
}
