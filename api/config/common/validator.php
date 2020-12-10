<?php

declare(strict_types=1);

use App\Infrastructure\Doctrine\Factory\ValidatorFactory;
use Symfony\Component\Validator\Validator\ValidatorInterface;

return [
    ValidatorInterface::class => DI\factory(ValidatorFactory::class)
];