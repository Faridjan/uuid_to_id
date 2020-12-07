<?php

declare(strict_types=1);

namespace App\Model\Transformer\Test\Type;

use App\Model\Transformer\Type\UUIDType;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;

class UUIDTypeTest extends TestCase
{
    public function testSuccess(): void
    {

        $UUIDType = new UUIDType($uuid = Uuid::uuid4()->toString());

        self::assertEquals($uuid, $UUIDType->getValue());
    }

    public function testIncorrectValue(): void
    {
        $this->expectException(InvalidArgumentException::class);

        new UUIDType('0');
    }

    public function testNotEmptyValueMessage(): void
    {
        $this->expectExceptionMessage('The value cannot be empty');

        new UUIDType('');
    }

    public function testIncorrectValueMessage(): void
    {
        $this->expectExceptionMessage('The value must be UUID type.');

        new UUIDType('UUID');
    }

    public function testIsEqualTo(): void
    {
        $UUID = Uuid::uuid4()->toString();
        $differentUUID = Uuid::uuid4()->toString();

        $UUIDType = new UUIDType($UUID);

        $another = new UUIDType($UUID);
        $anotherYet = new UUIDType($differentUUID);

        self::assertTrue($UUIDType->isEqualTo($another));
        self::assertFalse($UUIDType->isEqualTo($anotherYet));
    }
}
