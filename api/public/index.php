<?php
declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

$container = require __DIR__ . '/../config/container.php';
$app = \Slim\Factory\AppFactory::createFromContainer($container);

(require __DIR__ . '/../config/middleware.php')($app, $container);
(require __DIR__ . '/../config/routes.php')($app);

$app->run();