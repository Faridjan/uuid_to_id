<?php

declare(strict_types=1);

use App\Middleware\DomainExceptionHandler;
use App\Middleware\ValidationExceptionHandler;
use Slim\App;
use Slim\Middleware\ErrorMiddleware;

return static function (App $app) {
    $app->add(ValidationExceptionHandler::class);
    $app->add(DomainExceptionHandler::class);
    $app->add(DomainExceptionHandler::class);
    $app->addBodyParsingMiddleware();

    $app->add(ErrorMiddleware::class);
};
