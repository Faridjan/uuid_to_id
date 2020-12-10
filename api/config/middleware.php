<?php

declare(strict_types=1);

use App\Middleware\DomainExceptionHandler;
use App\Middleware\ValidationExceptionHandler;
use Psr\Container\ContainerInterface;
use Slim\App;

return static function (App $app, ContainerInterface $container) {
    /** @psalm-var array{debug:bool} */
    $config = $container->get('config');

    $app->add(ValidationExceptionHandler::class);
    $app->add(DomainExceptionHandler::class);
    $app->addBodyParsingMiddleware();
    $app->addErrorMiddleware($config['debug'], $config['env'] !== 'test', true);
};
