<?php

declare(strict_types=1);

namespace App\Domains\Auth\Domain\ValueObjects;

/**
 * メンターのid
 */
class MentorIdVO
{
    /**
     * @var int
     */
    private int $_value;

    /**
     * @param int $id
     */
    private function __construct(int $id)
    {
        $this->_value = $id;
    }

    /**
     * @param int $id
     * @return self
     */
    public static function create(int $id): self
    {
        return new self($id);
    }

    /**
     * @return int
     */
    public function value(): int
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
