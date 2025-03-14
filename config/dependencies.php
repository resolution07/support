<?php


declare(strict_types=1);

use Psr\Container\ContainerInterface;
use Resolution07\User\Application\Commands\CreateUserCommandHandler;
use Resolution07\User\Application\Queries\FindUserByLoginQueryHandler;
use Resolution07\User\Infrastructure\Repositories\InMemory\CreateUserRepository;
use Resolution07\User\Infrastructure\Repositories\InMemory\FindUserRepository;

return function (ContainerInterface $container) {
    $container->set('db', function () use ($container) {
        $settings = $container->get('settings')['db'];
        return new mysqli(
            $settings['host'],
            $settings['username'],
            $settings['password'],
            $settings['database']
        );
    });
    $container->set(
        CreateUserCommandHandler::class,
        new CreateUserCommandHandler(
            new CreateUserRepository()
        )
    );
    $container->set(
        FindUserByLoginQueryHandler::class,
        new FindUserByLoginQueryHandler(
            new FindUserRepository()
        )
    );
};