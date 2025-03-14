<?php

namespace Resolution07\Support\Domain\Repositories\Commands\Ticket;

use Resolution07\Support\Domain\Entities\Ticket;
use Resolution07\Support\Domain\Exceptions\TicketNotFoundException;

interface LoadTicketRepositoryInterface
{
    /**
     * @param string $uid
     * @return Ticket
     * @throws TicketNotFoundException
     */
    public function findByUID(string $uid): Ticket;
}
