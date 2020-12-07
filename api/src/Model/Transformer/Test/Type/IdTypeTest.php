<?php

declare(strict_types=1);


namespace App\Model\Transformer\Test\Type;


use App\Model\Transformer\Type\IdType;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class IdTypeTest extends TestCase
{
    public function testSuccess(): void
    {
        $idType = new IdType($value = 10);

        self::assertEquals($value, $idType->getValue());
    }

    public function testIncorrectValue(): void
    {
        $this->expectException(InvalidArgumentException::class);

        new IdType(0);
    }

    public function testIncorrectValueMessage(): void
    {
        $this->expectExceptionMessage('The value must be greater than 0.');

        new IdType(-1);
    }

    public function testIncorrectNullValueMessage(): void
    {
        $this->expectExceptionMessage('The value cannot be empty.');

        new IdType(0);
    }

    public function testIsEqualTo(): void
    {
        $idType = new IdType(2);

        $another = new IdType(2);
        $anotherYet = new IdType(3);

        self::assertTrue($idType->isEqualTo($another));
        self::assertFalse($idType->isEqualTo($anotherYet));
    }

}