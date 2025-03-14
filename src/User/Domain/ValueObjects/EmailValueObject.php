<?php

declare(strict_types=1);

namespace Resolution07\User\Domain\ValueObjects;

use Resolution07\Shared\Domain\Exceptions\DomainException;
use Resolution07\Shared\Domain\ValueObjects\StringValueObject;
use Resolution07\User\Domain\Exceptions\InvalidEmailException;

class EmailValueObject extends StringValueObject
{
    /**
     * @param string $value
     * @throws DomainException
     * @throws InvalidEmailException
     */
    public function __construct(string $value)
    {
        parent::__construct($value);
    }

    /**
     * @param string $value
     * @return void
     * @throws InvalidEmailException
     */
    protected function assertValue(string $value): void
    {
        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidEmailException();
        }
    }
}
