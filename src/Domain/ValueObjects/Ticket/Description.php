<?php

namespace Resolution07\Support\Domain\ValueObjects\Ticket;

use Resolution07\Support\Domain\Exceptions\DomainException;
use Resolution07\Support\Domain\Exceptions\InvalidTicketDescriptionLengthException;
use Resolution07\Support\Domain\ValueObjects\StringValueObject;

class Description extends StringValueObject
{
    public const int MAX_LENGTH = 5000;
    public const int MIN_LENGTH = 20;

    /**
     * @param $value
     * @throws DomainException
     * @throws InvalidTicketDescriptionLengthException
     */
    public function __construct($value)
    {
        parent::__construct($value);
    }

    /**
     * @throws InvalidTicketDescriptionLengthException
     */
    protected function assertValue(string $value): void
    {
        if (strlen($value) > self::MAX_LENGTH || strlen($value) < self::MIN_LENGTH) {
            throw new InvalidTicketDescriptionLengthException(
                sprintf("Must be between %d and %d characters.", self::MAX_LENGTH, self::MIN_LENGTH)
            );
        }
    }
}