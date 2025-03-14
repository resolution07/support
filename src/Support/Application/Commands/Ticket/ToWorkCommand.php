<?php

namespace Resolution07\Support\Application\Commands\Ticket;

final readonly class ToWorkCommand
{
    public function __construct(public string $ticketUID, public string $responsibleManagerEmail)
    {
    }
}
