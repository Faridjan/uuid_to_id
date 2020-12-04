<?php

return static function (\Slim\App $app, \Psr\Container\ContainerInterface $container) {
    $app->addErrorMiddleware($container->get('config')['debug'], true, true);
};
