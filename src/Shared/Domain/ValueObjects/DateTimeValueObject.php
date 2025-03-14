<?php

namespace Resolution07\Shared\Domain\ValueObjects;

use DateTimeInterface;
use Resolution07\Shared\Domain\Exceptions\DomainException;

abstract class DateTimeValueObject
{
    private DateTimeInterface $value;

    /**
     * @param DateTimeInterface $value
     * @throws DomainException
     */
    public function __construct(DateTimeInterface $value)
    {
        $this->assertValue($value);
        $this->value = $value;
    }

    public function getValue(): DateTimeInterface
    {
        return $this->value;
    }

    /**
     * @param DateTimeInterface $value
     * @return void
     * @throws DomainException
     */
    abstract protected function assertValue(DateTimeInterface $value): void;
}
