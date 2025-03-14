<?php

declare(strict_types=1);

namespace Resolution07\Shared\Domain\ValueObjects;

use Resolution07\Shared\Domain\Exceptions\DomainException;
use Stringable;

abstract class StringValueObject implements Stringable
{
    protected string $value;

    /**
     * @param string $value
     * @throws DomainException
     */
    public function __construct(string $value)
    {
        $this->assertValue($value);
        $this->value = $value;
    }

    final public function value(): string
    {
        return $this->value;
    }

    final public function __toString(): string
    {
        return $this->value();
    }

    public function equalTo(StringValueObject $value): bool
    {
        return $this->value() === $value->value();
    }

    /**
     * @param string $value
     * @return void
     * @throws DomainException
     */
    abstract protected function assertValue(string $value): void;
}
