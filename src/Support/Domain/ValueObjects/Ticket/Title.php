<?php

namespace Resolution07\Support\Domain\ValueObjects\Ticket;

use Resolution07\Shared\Domain\Exceptions\DomainException;
use Resolution07\Shared\Domain\ValueObjects\StringValueObject;
use Resolution07\Support\Domain\Exceptions\InvalidTicketTitleLengthException;

class Title extends StringValueObject
{
    public const int MAX_LENGTH = 60;
    public const int MIN_LENGTH = 5;

    /**
     * @param $value
     * @throws DomainException
     * @throws InvalidTicketTitleLengthException
     */
    public function __construct($value)
    {
        parent::__construct($value);
    }

    /**
     * @throws InvalidTicketTitleLengthException
     */
    protected function assertValue(string $value): void
    {
        if (strlen($value) > self::MAX_LENGTH || strlen($value) < self::MIN_LENGTH) {
            throw new InvalidTicketTitleLengthException(
                sprintf("Must be between %d and %d characters.", self::MIN_LENGTH, self::MAX_LENGTH)
            );
        }
    }
}
