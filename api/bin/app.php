<?php

declare(strict_types=1);

use Doctrine\Migrations\Tools\Console\Helper\ConfigurationHelper;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\Console\Helper\EntityManagerHelper;
use Symfony\Component\Console\Command\Command;

require __DIR__ . '/../vendor/autoload.php';

/**
 * @var \Psr\Container\ContainerInterface $container
 */
$container = require __DIR__ . '/../config/container.php';

$cli = new \Symfony\Component\Console\Application('Console');


/**
 * @var string[] $commands
 * @psalm-suppress MixedArrayAccess
 */
$commands = $container->get('config')['console']['commands'];

/** @var EntityManagerInterface $entityManager */
$entityManager = $container->get(EntityManagerInterface::class);
$connection = $entityManager->getConnection();

$configuration = new \Doctrine\Migrations\Configuration\Configuration($connection);
$configuration->setMigrationsDirectory(__DIR__ . '/../src/Migration');
$configuration->setMigrationsNamespace('App\Migration');
$configuration->setMigrationsColumnName('migration');
$configuration->setAllOrNothing(true);

$cli->getHelperSet()->set(new EntityManagerHelper($entityManager), 'em');
$cli->getHelperSet()->set(new ConfigurationHelper($connection, $configuration), 'configuration');


foreach ($commands as $name) {
    /** @var Command $command */
    $command = $container->get($name);
    $cli->add($command);
}

$cli->run();
