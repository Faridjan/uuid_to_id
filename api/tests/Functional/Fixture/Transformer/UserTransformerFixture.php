<?php

declare(strict_types=1);


namespace Test\Functional\Fixture\Transformer;


use App\Model\Transformer\Entity\UserTransformer\UserTransformer;
use App\Model\Transformer\Type\UUIDType;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Persistence\ObjectManager;
use Ramsey\Uuid\Uuid;

class UserTransformerFixture extends AbstractFixture
{
    public const UUID_1 = '745f6574-62d5-4ed2-b55c-8dfb1984c55e';
    public const UUID_2 = '092f422d-c1c5-40d2-ac40-ef6b74313c7e';

    public function load(ObjectManager $manager): void
    {
        $user_transformer_1 = UserTransformer::createFromUUID(
            new UUIDType(self::UUID_1)
        );

        $user_transformer_2 = UserTransformer::createFromUUID(
            new UUIDType(self::UUID_2)
        );

        $manager->persist($user_transformer_1);
        $manager->persist($user_transformer_2);

        $manager->flush();
    }
}
