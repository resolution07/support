<?php


declare(strict_types=1);

use Slim\App;

return function (App $app) {
    /**
     * middleware для обработки ошибок
     */
    $app->addErrorMiddleware(true, true, true);
};