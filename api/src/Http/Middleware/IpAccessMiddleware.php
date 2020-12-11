<?php

declare(strict_types=1);


namespace App\Http\Middleware;


use App\Http\EmptyResponse;
use App\Http\JsonResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Symfony\Component\Finder\Exception\AccessDeniedException;

/**
 * Class IpAccessMiddleware
 * @package App\Http\Middleware
 */
class IpAccessMiddleware implements MiddlewareInterface
{

    private array $IPWhiteList;

    public function __construct(array $IPWhiteList)
    {
        $this->IPWhiteList = $IPWhiteList;
    }

    /**
     * @param ServerRequestInterface $request
     * @param RequestHandlerInterface $handler
     * @return ResponseInterface
     * @throws \JsonException
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
//        $clientIP = $request->getServerParams()['REMOTE_ADDR'];
        $clientIP = $request->getAttribute('ip_address');


        if (!in_array($clientIP, $this->IPWhiteList)) {
            return new JsonResponse(['message' => 'Access Denied!'], 400);
        }

        return $handler->handle($request);
    }
}