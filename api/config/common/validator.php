<?php

declare(strict_types=1);

use App\Infrastructure\Factory\ValidatorFactory;
use Symfony\Component\Validator\Validator\ValidatorInterface;

return [
    ValidatorInterface::class => DI\factory(ValidatorFactory::class)
];