<?php

namespace Resolution07\Support\Infrastructure\Controllers;

use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Resolution07\Support\Application\Commands\Ticket\CreateCommandHandler;
use Resolution07\Support\Application\Factories\Commands\Ticket\CreateCommandFactory;
use Resolution07\Support\Domain\Exceptions\InvalidTicketDescriptionLengthException;
use Resolution07\Support\Domain\Exceptions\InvalidTicketTitleLengthException;
use Resolution07\Support\Domain\Exceptions\InvalidUUIDLengthException;
use Resolution07\Support\Domain\Exceptions\TicketCreateException;

class TicketController
{
    public function __construct(private ContainerInterface $container)
    {
    }

    /**
     * @param Request $request
     * @param Response $response
     * @return Response
     * @throws InvalidTicketDescriptionLengthException
     * @throws InvalidTicketTitleLengthException
     * @throws InvalidUUIDLengthException
     * @throws TicketCreateException
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function create(Request $request, Response $response): Response
    {
        $command = (new CreateCommandFactory($request))->create();

        /** @var CreateCommandHandler $handler */
        $handler = $this->container->get(CreateCommandHandler::class);
        $uid = $handler->handle($command);

        $response->getBody()->write(json_encode(['uid' => $uid]));
        $response->withHeader('Content-Type', 'application/json');

        return $response;
    }

    public function read(Request $request, Response $response): Response
    {
        return $response->withHeader('Content-Type', 'application/json');
    }
}
