<?php

declare(strict_types=1);

use App\Console\FixturesLoadCommand;
use Doctrine\Migrations\Tools\Console\Command\DiffCommand;
use Doctrine\Migrations\Tools\Console\Command\GenerateCommand;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\Console\Command\SchemaTool\CreateCommand;
use Doctrine\ORM\Tools\Console\Command\SchemaTool\DropCommand;
use Psr\Container\ContainerInterface;

return [
    FixturesLoadCommand::class => static function (ContainerInterface $container) {
        $config = $container->get('config')['console'];

        $em = $container->get(EntityManagerInterface::class);

        return new FixturesLoadCommand(
            $em,
            $config['fixtures_paths']
        );
    },
    'config' => [
        'console' => [
            'commands' => [
                FixturesLoadCommand::class,

                CreateCommand::class,
                DropCommand::class,

                DiffCommand::class,
                GenerateCommand::class
            ],
            'fixtures_paths' => [
                __DIR__ . '/../../tests/Functional/Fixture/Transformer',
            ]
        ]
    ]
];
