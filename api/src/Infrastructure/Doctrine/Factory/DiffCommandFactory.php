<?php

declare(strict_types=1);


namespace App\Infrastructure\Doctrine\Factory;


use Doctrine\Migrations\Provider\OrmSchemaProvider;
use Doctrine\Migrations\Tools\Console\Command\DiffCommand;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Container\ContainerInterface;

class DiffCommandFactory
{
    public function __invoke(ContainerInterface $container): DiffCommand
    {
        return new DiffCommand(
            new OrmSchemaProvider(
                $container->get(EntityManagerInterface::class)
            )
        );
    }
}