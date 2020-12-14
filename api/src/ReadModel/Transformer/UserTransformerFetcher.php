<?php

declare(strict_types=1);

namespace App\ReadModel\Transformer;

use App\Helper\FormatHelper;
use App\Model\Transformer\Entity\UserTransformer\UserTransformer;
use App\Model\Transformer\Entity\UserTransformer\UserTransformerRepository;
use App\Model\Transformer\Type\UUIDType;

class UserTransformerFetcher
{
    private UserTransformerRepository $repository;

    public function __construct(UserTransformerRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getUserTransformerByUUID(UUIDType $uuid): array
    {
        return $this->convertTransformerToArray($this->repository->getByUUID($uuid));
    }

    public function convertTransformerToArray(UserTransformer $userTransformer): array
    {
        return [
            'id' => (int)$userTransformer->getId()->getValue(),
            'uuid' => $userTransformer->getUuid()->getValue(),
            'created_at' => $userTransformer->getCreatedAt()->format(FormatHelper::FRONTEND_DATE_FORMAT)
        ];
    }
}
