<?php

use App\Http\Action\HomeAction;

require __DIR__ . '/../vendor/autoload.php';

$builder = new DI\ContainerBuilder();

$builder->addDefinitions([
    'config' => [
        'debug' => (bool)getenv('APP_DEBUG')
    ]
]);

$container = $builder->build();

$app = \Slim\Factory\AppFactory::createFromContainer($container);

$app->addErrorMiddleware($container->get('config')['debug'], true, true);

(require __DIR__ . '/../config/routes.php')($app);

$app->run();