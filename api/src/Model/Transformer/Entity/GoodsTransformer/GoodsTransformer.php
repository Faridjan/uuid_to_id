<?php
declare(strict_types=1);


namespace App\Model\Transformer\Entity\GoodsTransformer;


use App\Model\Transformer\Type\IdType;
use App\Model\Transformer\Type\UUIDType;

class GoodsTransformer
{
    private IdType $id;
    private UUIDType $uuid;
}