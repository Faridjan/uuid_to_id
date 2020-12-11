<?php

declare(strict_types=1);

namespace App\Http\Action\Transformer\UserTransformer;

use App\Http\JsonResponse;
use App\Model\Transformer\Command\UserTransformer\UserTransformer\Command;
use App\Model\Transformer\Type\UUIDType;
use App\ReadModel\Transformer\UserTransformerFetcher;
use App\Validator\Validator;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class UserTransformerAction implements RequestHandlerInterface
{

    private UserTransformerFetcher $fetcher;

    private Validator $validator;

    public function __construct(UserTransformerFetcher $fetcher, Validator $validator)
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

        $response = $this->fetcher->getUserTransformerByUUID(new UUIDType($uuid));

        return new JsonResponse($response);
    }
}
