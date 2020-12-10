<?php

declare(strict_types=1);

namespace App\Model\Transformer\Type;

use Webmozart\Assert\Assert;

use function DI\string;

class IdType
{
    private int $value;

    public function __construct(int $value)
    {
        Assert::notEmpty($value, 'The value cannot be empty.');
        Assert::integer($value, 'The value must be integer type.');
        Assert::greaterThan($value, 0, 'The value must be greater than 0.');

        $this->value = $value;
    }

    public function getValue(): int
    {
        return $this->value;
    }

    public function isEqualTo(self $another): bool
    {
        if ($this->getValue() === $another->getValue()) {
            return true;
        }

        return false;
    }

    public function __toString(): string
    {
        return (string)$this->value;
    }
}
