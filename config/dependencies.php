<?php


declare(strict_types=1);

use Psr\Container\ContainerInterface;
use Resolution07\Support\Application\Commands\Ticket\CreateCommandHandler;
use Resolution07\Support\Infrastructure\Repositories\MySQL\Commands\Ticket\CreateCommandRepository;

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
    $container->set(CreateCommandHandler::class, new CreateCommandHandler(new CreateCommandRepository()));
};