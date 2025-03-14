<?php

declare(strict_types=1);

namespace Resolution07\User\Application\Factories;

use Resolution07\User\Application\Commands\CreateUserCommand;
use Slim\Psr7\Request;

final readonly class CreateUserCommandFactory
{
    public static function FromRequest(Request $request): CreateUserCommand
    {
        $rawBody = $request->getBody()->getContents();
        $body = json_decode($rawBody, true);

        return new CreateUserCommand(
            (string)$body['login'],
            (string)$body['email'],
            (string)$body['name'],
            (string)$body['surname'],
            (string)$body['patronymic'],
        );
    }
}
