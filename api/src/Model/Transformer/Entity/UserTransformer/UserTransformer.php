<?php

declare(strict_types=1);

namespace App\Model\Transformer\Entity\UserTransformer;

use App\Model\Transformer\Type\IdType;
use App\Model\Transformer\Type\UUIDType;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class UserTransformer
 * @package App\Model\Transformer\Entity\UserTransformer
 * @ORM\Entity
 */
class UserTransformer
{
    /**
     * @ORM\Id
     * @ORM\Column(type="id_type", unique=true)
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="user_transformer_id_seq", initialValue=1, allocationSize=1)
     */
    private IdType $id;
    /**
     * @ORM\Column(type="uuid_type", unique=true)
     */
    private UUIDType $uuid;

    /**
     * UserTransformer constructor.
     * @param UUIDType $uuid
     */
    private function __construct(UUIDType $uuid)
    {
        $this->uuid = $uuid;
    }

    /**
     * @return null|IdType
     */
    public function getId(): ?IdType
    {
        return $this->id ?? null;
    }

    /**
     * @return UUIDType
     */
    public function getUuid(): UUIDType
    {
        return $this->uuid;
    }

    public static function createFromUUID(UUIDType $uuid): self
    {
        return new self($uuid);
    }
}