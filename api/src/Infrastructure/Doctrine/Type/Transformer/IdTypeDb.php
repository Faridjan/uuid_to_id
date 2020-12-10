<?php

declare(strict_types=1);

namespace App\Infrastructure\Doctrine\Type\Transformer;

use App\Model\Transformer\Type\IdType;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\IntegerType;

class IdTypeDb extends IntegerType
{
    public const NAME = 'id_type';

    public function convertToDatabaseValue($value, AbstractPlatform $platform): int
    {
        /**
         * @var IdType $value
         */
        return $value instanceof IdType ? $value->getValue() : (int)$value;
    }

    public function convertToPHPValue($value, AbstractPlatform $platform): ?IdType
    {
        return !empty($value) ? new IdType((int)$value) : null;
    }

    public function getName(): string
    {
        return self::NAME;
    }

    public function requiresSQLCommentHint(AbstractPlatform $platform): bool
    {
        return true;
    }
}
