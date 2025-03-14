<?php

use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Slim\Routing\RouteCollectorProxy;

return function (Slim\App $app) {
    $app->group('/api', function (RouteCollectorProxy $group) {
        $group->get('/users', function (Request $request, Response $response) {
            $response->getBody()->write(json_encode(['id' => 1]));
            return $response->withHeader('Content-Type', 'application/json');
        });
    });
};