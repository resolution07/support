<?php

namespace Resolution07\Support\Domain\ValueObjects\Ticket;

use DateTime;
use DateTimeInterface;
use Resolution07\Shared\Domain\Exceptions\DomainException;
use Resolution07\Shared\Domain\ValueObjects\DateTimeValueObject;
use Resolution07\Support\Domain\Exceptions\InvalidCreatedAtDateException;

class CreatedAt extends DateTimeValueObject
{
    /**
     * @param DateTimeInterface $value
     * @throws DomainException
     * @throws InvalidCreatedAtDateException
     */
    public function __construct(DateTimeInterface $value)
    {
        parent::__construct($value);
    }

    /**
     * @throws InvalidCreatedAtDateException
     */
    protected function assertValue(DateTimeInterface $value): void
    {
        if ($value->getTimestamp() < (new DateTime())->getTimestamp()) {
            throw new InvalidCreatedAtDateException('Created at must be less than or equal to current time');
        }
    }
}
