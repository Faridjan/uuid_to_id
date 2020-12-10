<?php

declare(strict_types=1);

use App\Console\HelloCommand;
use Doctrine\Migrations\Tools\Console\Command\ExecuteCommand;
use Doctrine\Migrations\Tools\Console\Command\LatestCommand;
use Doctrine\Migrations\Tools\Console\Command\MigrateCommand;
use Doctrine\Migrations\Tools\Console\Command\StatusCommand;
use Doctrine\ORM\Tools\Console\Command\SchemaTool\UpdateCommand;
use Doctrine\ORM\Tools\Console\Command\ValidateSchemaCommand;

return [
    'config' => [
        'console' => [
            'commands' => [
                HelloCommand::class,
                ValidateSchemaCommand::class,

                ExecuteCommand::class,
                MigrateCommand::class,
                StatusCommand::class,
                LatestCommand::class,
                UpdateCommand::class
            ]
        ]
    ]
];
