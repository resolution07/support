<?php

namespace Resolution07\Support\Infrastructure\Repositories\MySQL\Commands\Ticket;

use Resolution07\Support\Domain\Entities\Ticket;
use Resolution07\Support\Domain\Repositories\Commands\Ticket\CreateCommandRepositoryInterface;

class CreateCommandRepository implements CreateCommandRepositoryInterface
{
    public function store(Ticket $ticket): string
    {
        return $ticket->getUid()->getValue();
    }
}