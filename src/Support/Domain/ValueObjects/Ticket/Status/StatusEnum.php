<?php

namespace Resolution07\Support\Domain\ValueObjects\Ticket\Status;

enum StatusEnum: string
{
    case OPEN = Open::class;
    case CLOSED = Closed::class;
    case IN_PROGRESS = InProgress::class;
}
