<?php

declare(strict_types=1);

namespace App\Domains\Auth\Domain\ValueObjects;

/**
 * メンターの名前
 */
class MentorNameVO
{
    /**
     * @var string
     */
    private string $_value;

    /**
     * @param string $name
     */
    private function __construct(string $name)
    {
        $this->_value = $name;
    }

    /**
     * @param string $name
     * @return self
     */
    public static function create(string $name): self
    {
        return new self($name);
    }

    /**
     * @return string
     */
    public function value(): string
    {
        return $this->_value;
    }

    /**
     * @param self $other
     * @return bool
     */
    public function equals(self $other): bool
    {
        return $this->_value === $other->value();
    }
}
