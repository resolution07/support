<?php

declare(strict_types=1);

namespace Resolution07\Support\Application\Factories\Commands\Ticket;

use Ramsey\Uuid\Uuid;
use Resolution07\Support\Application\Commands\Ticket\CreateCommand;
use Slim\Psr7\Request;

use function DI\string;

final class CreateCommandFactory implements CreateCommandFactoryInterface
{
    public function __construct(private readonly Request $request)
    {
    }

    public function create(): CreateCommand
    {
        $rawBody = $this->request->getBody()->getContents();
        $body = json_decode($rawBody, true);

        return new CreateCommand(
            Uuid::uuid7()->toString(),
            (string)$body['title'],
            (string)$body['description'],
        );
    }
}
