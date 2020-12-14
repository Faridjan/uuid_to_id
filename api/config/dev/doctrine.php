<?php

declare(strict_types=1);

use App\Doctrine\FixDefaultSchemaSubscriber;
use App\Infrastructure\Factory\DiffCommandFactory;
use Doctrine\Migrations\Tools\Console\Command\DiffCommand;

return [
    DiffCommand::class => Di\factory(DiffCommandFactory::class),
    'config' => [
        'doctrine' => [
            'dev_mode' => true,
            'cache_dir' => null,
            'proxy_dri' => __DIR__ . '/../../var/cache/' . PHP_SAPI . '/doctrine/proxy',
            'subscribers' => [
                FixDefaultSchemaSubscriber::class
            ]
        ]
    ]

];
