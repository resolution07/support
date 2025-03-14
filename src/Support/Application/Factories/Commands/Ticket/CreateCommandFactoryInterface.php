<?php

namespace Resolution07\Support\Application\Factories\Commands\Ticket;

use Resolution07\Support\Application\Commands\Ticket\CreateCommand;

interface CreateCommandFactoryInterface
{
    public function create(): CreateCommand;
}
