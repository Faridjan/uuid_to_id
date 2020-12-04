<?php

$builder = new DI\ContainerBuilder();
$builder->addDefinitions(__DIR__ . '/dependencies.php');
return $builder->build();
