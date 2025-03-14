<?php

declare(strict_types=1);

namespace Resolution07\Shared\Domain\ValueObjects;

use Resolution07\Support\Domain\Exceptions\InvalidUUIDLengthException;

class Uuid7 extends Uuid
{
    public const int LENGTH = 36;

    /**
     * @throws InvalidUUIDLengthException
     */
    protected function assertValue(string $value): void
    {
        if (strlen($value) !== self::LENGTH) {
            throw new InvalidUUIDLengthException();
        }
    }
}
