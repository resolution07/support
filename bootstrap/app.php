<?php

use Slim\Factory\AppFactory;

require __DIR__ . '/../vendor/autoload.php';

$container = new DI\Container();

$settings = require __DIR__ . '/../config/settings.php';
$container->set('settings', $settings);

AppFactory::setContainer($container);
$app = AppFactory::create();

(require __DIR__ . '/../config/dependencies.php')($container);
(require __DIR__ . '/../config/middleware.php')($app);
(require __DIR__ . '/../router/api.php')($app);


$app->run();