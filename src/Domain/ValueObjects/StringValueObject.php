<?php

namespace Resolution07\Support\Domain\ValueObjects;

use Resolution07\Support\Domain\Exceptions\DomainException;

abstract class StringValueObject
{
    private string $value;

    /**
     * @param $value
     * @throws DomainException
     */
    public function __construct($value)
    {
        $this->assertValue($value);
        $this->value = $value;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * @param string $value
     * @return void
     * @throws DomainException
     */
    abstract protected function assertValue(string $value): void;
}