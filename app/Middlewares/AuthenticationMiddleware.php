<?php

namespace App\Middlewares;


use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\EmptyResponse;

class AuthenticationMiddleware implements MiddlewareInterface
{

    /**
     * Process an incoming server request.
     *
     * Processes an incoming server request in order to produce a response.
     * If unable to produce the response itself, it may delegate to the provided
     * request handler to do so.
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        if (substr($request->getUri()->getPath(), 0, 6) === '/admin') {
            $sessionUserId = $_SESSION['userId'] ?? null;
            if (!$sessionUserId) {
                return new EmptyResponse(401);
            }
        }

        return $handler->handle($request);
    }
}