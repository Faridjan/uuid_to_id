<?php

declare(strict_types=1);

use App\Http\Middleware\IpAccessMiddleware;
use Psr\Container\ContainerInterface;
use RKA\Middleware\IpAddress;

return [
    IpAccessMiddleware::class => function (ContainerInterface $container) {
        return new IpAccessMiddleware($container->get('config')['ip_white_list']);
    },

    'config' => [
        'ip_white_list' => [
            '127.0.0.0',
            '127.0.0.1',
            '172.20.0.2'
        ]
    ]
];