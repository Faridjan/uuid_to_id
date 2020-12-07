<?php

declare(strict_types=1);

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

$entityManager = $container->get(\Doctrine\ORM\EntityManagerInterface::class);
$cli->getHelperSet()->set(new \Doctrine\ORM\Tools\Console\Helper\EntityManagerHelper($entityManager), 'em');


foreach ($commands as $commandName) {
    $cli->add($container->get($commandName));
}

$cli->run();
