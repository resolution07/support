<?php

namespace Resolution07\Support\Domain\Repositories\Commands\Ticket;

use Resolution07\Support\Domain\Entities\Ticket;
use Resolution07\Support\Domain\Exceptions\TicketCreateException;

interface CreateCommandRepositoryInterface
{
    /**
     * @param Ticket $ticket
     * @return string
     * @throws TicketCreateException
     */
    public function store(Ticket $ticket): string;
}