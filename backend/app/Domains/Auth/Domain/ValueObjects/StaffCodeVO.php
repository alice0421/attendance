<?php

declare(strict_types=1);

namespace App\Domains\Auth\Domain\ValueObjects;

/**
 * メンターのcode
 */
class StaffCodeVO
{
    /**
     * @var string
     */
    private string $_value;

    /**
     * @param string $code
     */
    private function __construct(string $code)
    {
        $this->_value = $code;
    }

    /**
     * @param string $code
     * @return self
     */
    public static function create(string $code): self
    {
        return new self($code);
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
