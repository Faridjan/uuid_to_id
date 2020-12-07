<?php
declare(strict_types=1);


namespace App\Model\Transformer\Entity\UserTransformer;


use App\Model\Transformer\Type\IdType;
use App\Model\Transformer\Type\UUIDType;

class UserTransformer
{
    private IdType $id;
    private UUIDType $uuid;
}