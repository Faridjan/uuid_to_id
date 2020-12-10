<?php

declare(strict_types=1);


namespace App\Model\Transformer\Test\Entity;


use App\Model\Transformer\Entity\UserTransformer\UserTransformer;
use App\Model\Transformer\Type\UUIDType;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;
use TypeError;

class UserTransformerTest extends TestCase
{
    public function testSuccess(): void
    {
        $UUIDType = new UUIDType(Uuid::uuid4()->toString());

        $userTransformer = UserTransformer::createFromUUID($UUIDType);

        self::assertTrue($userTransformer instanceof UserTransformer);
        self::assertTrue($userTransformer->getUuid() instanceof UUIDType);
        self::assertTrue($userTransformer->getUuid()->getValue() === $UUIDType->getValue());
    }

    public function testNullId(): void
    {
        $UUIDType = new UUIDType(Uuid::uuid4()->toString());

        $userTransformer = UserTransformer::createFromUUID($UUIDType);

        self::assertNull($userTransformer->getId());
    }

    public function testEmptyUUIDValue(): void
    {
        $this->expectException(TypeError::class);
        UserTransformer::createFromUUID(null);
    }
}