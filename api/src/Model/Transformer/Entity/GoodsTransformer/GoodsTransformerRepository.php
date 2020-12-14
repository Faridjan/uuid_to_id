<?php

declare(strict_types=1);

namespace App\Model\Transformer\Entity\GoodsTransformer;

use App\Model\Transformer\Type\UUIDType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use DomainException;

class GoodsTransformerRepository
{
    private EntityManagerInterface $em;

    private EntityRepository $repository;

    public function __construct(
        EntityManagerInterface $em,
        EntityRepository $repository
    ) {
        $this->em = $em;
        $this->repository = $repository;
    }

    public function add(GoodsTransformer $entity): void
    {
        $this->em->persist($entity);
    }

    public function remove(GoodsTransformer $entity): void
    {
        $this->em->remove($entity);
    }

    public function hasByUUID(UUIDType $uuid): bool
    {
        return $this->repository->createQueryBuilder('t')
                ->setParameter(':uuid', $uuid)
                ->select('COUNT(t.id)')
                ->andWhere('t.uuid = :uuid')
                ->getQuery()
                ->getSingleScalarResult() > 0;
    }

    public function getByUUID(UUIDType $uuid): GoodsTransformer
    {
        if (!$goodsTransformer = $this->repository->findOneBy(['uuid' => $uuid->getValue()])) {
            throw new DomainException('The Goods Transformer not found.');
        }

        /** @var  GoodsTransformer $goodsTransformer */
        return $goodsTransformer;
    }
}
