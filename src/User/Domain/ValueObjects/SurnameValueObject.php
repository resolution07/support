<?php

declare(strict_types=1);

namespace Resolution07\User\Domain\ValueObjects;

use Resolution07\Shared\Domain\Exceptions\DomainException;
use Resolution07\Shared\Domain\ValueObjects\StringValueObject;
use Resolution07\User\Domain\Exceptions\EmptyUserSurnameException;

class SurnameValueObject extends StringValueObject
{
    /**
     * @param string $value
     * @throws DomainException
     * @throws EmptyUserSurnameException
     */
    public function __construct(string $value)
    {
        parent::__construct($value);
    }

    /**
     * @param string $value
     * @return void
     * @throws EmptyUserSurnameException
     */
    protected function assertValue(string $value): void
    {
        if (empty($value)) {
            throw new EmptyUserSurnameException();
        }
    }
}
