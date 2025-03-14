<?php

namespace Resolution07\Support\Domain\ValueObjects;

use Resolution07\Support\Domain\Exceptions\DomainException;
use Resolution07\Support\Domain\Exceptions\InvalidUUIDLengthException;

final class UID extends StringValueObject
{
    public const int LENGTH = 36;

    /**
     * @param $value
     * @throws DomainException
     * @throws InvalidUUIDLengthException
     */
    public function __construct($value)
    {
        parent::__construct($value);
    }

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