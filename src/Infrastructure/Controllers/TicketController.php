<?php

namespace Resolution07\Support\Infrastructure\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class TicketController
{
    public function index(Request $request, Response $response): Response
    {
        $response->getBody()->write(json_encode(['id' => 1]));
        return $response->withHeader('Content-Type', 'application/json');
    }
}