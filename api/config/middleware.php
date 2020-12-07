<?php

declare(strict_types=1);

use Psr\Container\ContainerInterface;
use Slim\App;

return static function (App $app, ContainerInterface $container) {
    /** @psalm-var array{debug:bool} */
    $config = $container->get('config');

    $app->addErrorMiddleware($config['debug'], $config['env'] !== 'test', true);
};
