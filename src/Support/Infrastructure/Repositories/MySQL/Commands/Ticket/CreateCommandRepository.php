<?php

namespace Resolution07\Support\Infrastructure\Repositories\MySQL\Commands\Ticket;

use mysqli;
use Resolution07\Support\Domain\Entities\Ticket;
use Resolution07\Support\Domain\Exceptions\TicketCreateException;
use Resolution07\Support\Domain\Repositories\Commands\Ticket\CreateCommandRepositoryInterface;
use Resolution07\Support\Domain\ValueObjects\Ticket\Status\StatusEnum;
use Throwable;

class CreateCommandRepository implements CreateCommandRepositoryInterface
{
    public function __construct(private mysqli $db)
    {
    }

    public function store(Ticket $ticket): string
    {
        try {
            return $this->storeInternal($ticket);
        } catch (Throwable $throwable) {
            throw new TicketCreateException($throwable->getMessage(), $throwable->getCode(), $throwable);
        }
    }

    private function storeInternal(Ticket $ticket): string
    {
        $statement = $this->db->prepare(
            'INSERT INTO tickets(uid, title, description, status, created_at, updated_at) VALUES(?, ?, ?, ?, ?, ?)'
        );

        $data = $this->prepareTicketData($ticket);
        $statement->bind_param('ssssss', ...$data);

        $statement->execute();
        $statement->close();

        return $ticket->getUid()->getValue();
    }

    private function prepareTicketData(Ticket $ticket): array
    {
        return [
            $ticket->getUid()->getValue(),
            $ticket->getTitle()->getValue(),
            $ticket->getDescription()->getValue(),
            StatusEnum::tryFrom($ticket->getStatus()::class)->name,
            $ticket->getCreatedAt()->getValue()->format('Y-m-d H:i:s'),
            $ticket->getUpdatedAt()->getValue()->format('Y-m-d H:i:s'),
        ];
    }
}
