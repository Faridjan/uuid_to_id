<?php

declare(strict_types=1);

use App\Http\Middleware\IpAccessMiddleware;
use Psr\Container\ContainerInterface;

return [
    IpAccessMiddleware::class => function (ContainerInterface $container) {
        /**
         * @psalm-suppress MixedArrayAccess
         * @psalm-var array{
         *      ip_white_list:array
         * } $config
         */
        $config = $container->get('config');
        return new IpAccessMiddleware($config['ip_white_list']);
    },

    'config' => [
        'ip_white_list' => [
            '127.0.0.0',
            '127.0.0.1',
            '172.18.0.3'
        ]
    ]
];