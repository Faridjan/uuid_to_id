<?php

declare(strict_types=1);


namespace App\Middleware;


use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

//class ClearEmptyInput implements MiddlewareInterface
//{
//    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
//    {
//        $request = $request
//            ->withParsedBody(self::filterString($request->getParsedBody()));
//
//        return $handler->handle($request);
//    }
//
//    private static function filterString($items)
//    {
//        if(!is_array($items)) {
//
//        }
//    }
//}