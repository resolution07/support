<?php

namespace Resolution07\Support\Application\Commands\Ticket;

use Resolution07\Support\Domain\Entities\Ticket;
use Resolution07\Support\Domain\Exceptions\DomainException;
use Resolution07\Support\Domain\Exceptions\InvalidTicketDescriptionLengthException;
use Resolution07\Support\Domain\Exceptions\InvalidTicketTitleLengthException;
use Resolution07\Support\Domain\Exceptions\InvalidUUIDLengthException;
use Resolution07\Support\Domain\Exceptions\TicketCreateException;
use Resolution07\Support\Domain\Repositories\Commands\Ticket\CreateCommandRepositoryInterface;
use Resolution07\Support\Domain\ValueObjects\Ticket\Description;
use Resolution07\Support\Domain\ValueObjects\Ticket\Status\Open;
use Resolution07\Support\Domain\ValueObjects\Ticket\Title;
use Resolution07\Support\Domain\ValueObjects\UID;

class CreateCommandHandler
{
    public function __construct(private CreateCommandRepositoryInterface $repository)
    {
    }

    /**
     * @param CreateCommand $command
     * @return string ticket uid
     * @throws DomainException
     * @throws InvalidTicketDescriptionLengthException
     * @throws InvalidTicketTitleLengthException
     * @throws InvalidUUIDLengthException
     * @throws TicketCreateException
     */
    public function handle(CreateCommand $command): string
    {
        $ticket = new Ticket(
            new UID($command->uid),
            new Title($command->title),
            new Description($command->description),
            new Open()
        );

        return $this->repository->store($ticket);
    }
}