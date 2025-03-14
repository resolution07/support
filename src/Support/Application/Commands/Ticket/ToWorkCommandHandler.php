<?php

namespace Resolution07\Support\Application\Commands\Ticket;

use Resolution07\Support\Domain\Exceptions\TicketNotFoundException;
use Resolution07\Support\Domain\Repositories\Commands\Ticket\LoadTicketRepositoryInterface;
use Resolution07\Support\Domain\Repositories\Commands\Ticket\StoreTicketRepositoryInterface;

class ToWorkCommandHandler
{
    public function __construct(
        private StoreTicketRepositoryInterface $storeTicketRepository,
        private LoadTicketRepositoryInterface $loadTicketRepository
    ) {
    }

    /**
     * @param ToWorkCommand $command
     * @return true
     * @throws TicketNotFoundException
     */
    public function handle(ToWorkCommand $command): true
    {
        $ticket = $this->loadTicketRepository->findByUID($command->ticketUID);

        return true;
    }
}
