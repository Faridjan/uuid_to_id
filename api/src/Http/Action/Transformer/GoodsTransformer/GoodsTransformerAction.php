<?php

declare(strict_types=1);

namespace App\Http\Action\Transformer\GoodsTransformer;


use App\Http\JsonResponse;
use App\Model\Transformer\Command\GoodsTransformer\GoodsTransformer\Command;
use App\Model\Transformer\Type\UUIDType;
use App\ReadModel\Transformer\GoodsTransformerFetcher;
use App\Validator\Validator;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class GoodsTransformerAction implements RequestHandlerInterface
{

    private GoodsTransformerFetcher $fetcher;

    private Validator $validator;

    public function __construct(GoodsTransformerFetcher $fetcher, Validator $validator)
    {
        $this->fetcher = $fetcher;
        $this->validator = $validator;
    }

    /**
     * @param ServerRequestInterface $request
     * @return ResponseInterface
     * @throws \JsonException
     */
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $data = $request->getQueryParams();

        $uuid = $data['uuid'] ?? '';

        $command = new Command();
        $command->uuid = $uuid;

        $this->validator->validate($command);

        $response = $this->fetcher->getGoodsTransformerByUUID(new UUIDType($uuid));

        return new JsonResponse($response);
    }
}
