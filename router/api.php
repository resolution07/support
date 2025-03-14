<?php

use Resolution07\User\Infrastructure\Controllers\UserController;
use Slim\Routing\RouteCollectorProxy;

return function (Slim\App $app) {
    $app->group('/api', function (RouteCollectorProxy $group) {
        $group->group('/v1', function (RouteCollectorProxy $group) {
            $group->post('/user', [UserController::class, 'create']);
            $group->get('/user/{login}', [UserController::class, 'findByLogin']);


        });
    });
};