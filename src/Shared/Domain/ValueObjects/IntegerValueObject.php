<?php

declare(strict_types=1);

namespace Resolution07\Shared\Domain\ValueObjects;

use Resolution07\Shared\Domain\Exceptions\DomainException;

abstract class IntegerValueObject
{
    protected int $value;

    /**
     * @param int $value
     * @throws DomainException
     */
    public function __construct(int $value)
    {
        $this->assertValue($value);
        $this->value = $value;
    }

    final public function value(): int
    {
        return $this->value;
    }

    /**
     * @param int $value
     * @return void
     * @throws DomainException
     */
    abstract protected function assertValue(int $value): void;
}
