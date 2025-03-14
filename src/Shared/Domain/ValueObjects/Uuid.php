<?php

declare(strict_types=1);

namespace Resolution07\Shared\Domain\ValueObjects;

use Stringable;

abstract class Uuid extends StringValueObject implements Stringable
{
    final public function equals(self $other): bool
    {
        return $this->value() === $other->value();
    }

    public function __toString(): string
    {
        return $this->value;
    }
}
