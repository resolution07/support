<?php

declare(strict_types=1);

namespace Resolution07\User\Infrastructure\Controllers;

use DI\Container;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Resolution07\User\Application\Commands\CreateUserCommandHandler;
use Resolution07\User\Application\ExceptionHandlers\HTTP\Handler;
use Resolution07\User\Application\Factories\CreateUserCommandFactory;
use Resolution07\User\Application\Queries\FindUserByLoginQuery;
use Resolution07\User\Application\Queries\FindUserByLoginQueryHandler;
use Throwable;

readonly class UserController
{
    public function __construct(private Container $container)
    {
    }

    /**
     * @param Request $request
     * @param Response $response
     * @return Response
     */
    public function create(Request $request, Response $response): Response
    {
        try {
            $commandHandler = $this->container->get(CreateUserCommandHandler::class);
            $command = CreateUserCommandFactory::fromRequest($request);

            $userDTO = $commandHandler->handle($command);

            $response->getBody()->write(json_encode($userDTO));
            $response->withHeader('Content-Type', 'application/json');
            return $response;
        } catch (Throwable $throwable) {
            $errorResponse = Handler::handle($throwable);
            return $response->withStatus($errorResponse['code'], $errorResponse['message']);
        }
    }

    /**
     * @param Request $request
     * @param Response $response
     * @param $args
     * @return Response
     */
    public function findByLogin(Request $request, Response $response, $args): Response
    {
        try {
            $queryHandler = $this->container->get(FindUserByLoginQueryHandler::class);
            $userDTO = $queryHandler->handle(new FindUserByLoginQuery($args['login']));

            $response->getBody()->write(json_encode($userDTO));
            $response->withHeader('Content-Type', 'application/json');

            return $response;
        } catch (Throwable $throwable) {
            $errorResponse = Handler::handle($throwable);
            return $response->withStatus($errorResponse['code'], $errorResponse['message']);
        }
    }
}
