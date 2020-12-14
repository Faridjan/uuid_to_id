<?php

declare(strict_types=1);

namespace App\ReadModel\Transformer;

use App\Helper\FormatHelper;
use App\Model\Transformer\Entity\GoodsTransformer\GoodsTransformer;
use App\Model\Transformer\Entity\GoodsTransformer\GoodsTransformerRepository;
use App\Model\Transformer\Type\UUIDType;

class GoodsTransformerFetcher
{
    private GoodsTransformerRepository $repository;

    public function __construct(GoodsTransformerRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getGoodsTransformerByUUID(UUIDType $uuid): array
    {
        return $this->convertTransformerToArray($this->repository->getByUUID($uuid));
    }

    private function convertTransformerToArray(GoodsTransformer $goodsTransformer): array
    {
        return [
            'id' => (int)$goodsTransformer->getId()->getValue(),
            'uuid' => $goodsTransformer->getUuid()->getValue(),
            'created_at' => $goodsTransformer->getCreatedAt()->format(FormatHelper::FRONTEND_DATE_FORMAT)
        ];
    }
}
