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
        /**
         * @psalm-suppress MixedArrayAccess
         * @psalm-var array{string} $fixtures
         */
        $fixtures = $container->get('config')['console']['fixtures_paths'];

        /** @var EntityManagerInterface $em */
        $em = $container->get(EntityManagerInterface::class);

        return new FixturesLoadCommand(
            $em,
            $fixtures
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
                __DIR__ . '/../../tests/Functional/Api/Transformer/GoodsTransformer',
                __DIR__ . '/../../tests/Functional/Api/Transformer/UserTransformer',
            ]
        ]
    ]
];
