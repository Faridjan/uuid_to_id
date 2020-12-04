<?php

declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

$cli = new \Symfony\Component\Console\Application('Console');

$cli->add(new \App\Console\HelloCommand());

$cli->run();