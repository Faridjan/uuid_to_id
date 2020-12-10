<?php

declare(strict_types=1);

namespace App\Model\Transformer\Entity\GoodsTransformer;

use App\Model\Transformer\Type\IdType;
use App\Model\Transformer\Type\UUIDType;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class GoodsTransformer
{
    /**
     * @ORM\Id
     * @ORM\Column(type="id_type", unique=true)
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="goods_transform_id_seq", initialValue=1, allocationSize=1)
     */
    private IdType $id;

    /**
     * @ORM\Column(type="uuid_type", unique=true)
     */
    private UUIDType $uuid;

    private function __construct(UUIDType $uuid)
    {
        $this->uuid = $uuid;
    }

    public static function createFromUUID(UUIDType $uuid): self
    {
        return new self($uuid);
    }

    /**
     * @return null|IdType
     */
    public function getId(): ?IdType
    {
        return $this->id ?? null;
    }

    public function getUuid(): UUIDType
    {
        return $this->uuid;
    }
}
