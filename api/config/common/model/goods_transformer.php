<?php

declare(strict_types=1);

use App\Model\Transformer\Entity\GoodsTransformer\GoodsTransformer;
use App\Model\Transformer\Entity\GoodsTransformer\GoodsTransformerRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Psr\Container\ContainerInterface;

return [
    GoodsTransformerRepository::class => function (ContainerInterface $container): GoodsTransformerRepository {
        /** @var EntityManagerInterface $em */
        $em = $container->get(EntityManagerInterface::class);
        /** @var EntityRepository $repo */
        $repo = $em->getRepository(GoodsTransformer::class);
        return new GoodsTransformerRepository($em, $repo);
    }
];