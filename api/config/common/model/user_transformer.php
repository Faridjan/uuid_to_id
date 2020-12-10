<?php

declare(strict_types=1);

use App\Model\Transformer\Entity\UserTransformer\UserTransformer;
use App\Model\Transformer\Entity\UserTransformer\UserTransformerRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Psr\Container\ContainerInterface;

return [
    UserTransformerRepository::class => function (ContainerInterface $container): UserTransformerRepository {
        /** @var EntityManagerInterface $em */
        $em = $container->get(EntityManagerInterface::class);
        /** @var EntityRepository $repo */
        $repo = $em->getRepository(UserTransformer::class);
        return new UserTransformerRepository($em, $repo);
    }
];