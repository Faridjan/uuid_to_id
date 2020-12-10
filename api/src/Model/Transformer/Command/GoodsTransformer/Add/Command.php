<?php

declare(strict_types=1);

namespace App\Model\Transformer\Command\GoodsTransformer\Add;

use Symfony\Component\Validator\Constraints as Assert;

class Command
{
    /**
     * @Assert\NotBlank()
     * @Assert\Uuid()
     */
    public string $uuid;
}
