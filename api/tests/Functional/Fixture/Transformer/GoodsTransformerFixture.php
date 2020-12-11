<?php

declare(strict_types=1);


namespace Test\Functional\Fixture\Transformer;


use App\Model\Transformer\Entity\GoodsTransformer\GoodsTransformer;
use App\Model\Transformer\Type\UUIDType;
use DateTimeImmutable;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Persistence\ObjectManager;

class GoodsTransformerFixture extends AbstractFixture
{
    public const UUID_1 = 'f9714109-1dd0-4cef-a815-c8333f9a8fdb';
    public const UUID_2 = 'c9457425-007c-44e5-9577-6c20d5e4c19f';

    public function load(ObjectManager $manager): void
    {
        $goods_transformer_1 = GoodsTransformer::createFromUUID(
            new UUIDType(self::UUID_1),
            new DateTimeImmutable()
        );

        $goods_transformer_2 = GoodsTransformer::createFromUUID(
            new UUIDType(self::UUID_2),
            new DateTimeImmutable()
        );

        $manager->persist($goods_transformer_1);
        $manager->persist($goods_transformer_2);

        $manager->flush();
    }
}