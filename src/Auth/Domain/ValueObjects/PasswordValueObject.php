<?php

declare(strict_types=1);

namespace Resolution07\Auth\Domain\ValueObjects;

use Resolution07\Auth\Domain\Exceptions\EmptyPasswordException;
use Resolution07\Shared\Domain\Exceptions\DomainException;
use Resolution07\Shared\Domain\ValueObjects\StringValueObject;

final class PasswordValueObject extends StringValueObject
{
    /**
     * @param string $value
     * @throws DomainException
     * @throws EmptyPasswordException
     */
    public function __construct(string $value)
    {
        parent::__construct($value);
    }

    protected function assertValue(string $value): void
    {
        if (empty($value)) {
            throw new EmptyPasswordException();
        }
    }
}
