<?php

declare(strict_types=1);

namespace App\Http\Action\Transformer\GoodsTransformer;

use App\Http\EmptyResponse;
use App\Http\JsonResponse;
use App\Model\Transformer\Command\GoodsTransformer\Add\Command;
use App\Model\Transformer\Command\GoodsTransformer\Add\Handler;
use App\Validator\Validator;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class AddAction implements RequestHandlerInterface
{

    private Handler $handler;
    private Validator $validator;

    public function __construct(Handler $handler, Validator $validator)
    {
        $this->handler = $handler;
        $this->validator = $validator;
    }

    /**
     * @param ServerRequestInterface $request
     * @return ResponseInterface
     * @throws \JsonException
     */
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $data = $request->getParsedBody();

        $uuid = $data['uuid'] ?? '';

        $command = new Command();
        $command->uuid = $uuid;

        $this->validator->validate($command);

        $this->handler->handle($command);

        return new EmptyResponse(200);
    }
}
