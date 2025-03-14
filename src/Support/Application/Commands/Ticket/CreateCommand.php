<?php

namespace Resolution07\Support\Application\Commands\Ticket;

final readonly class CreateCommand
{
    public function __construct(
        public string $uid,
        public string $title,
        public string $description
    ) {
    }
}
