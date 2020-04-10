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
        $path = substr($request->getUri()->getPath(), 0, 6);
        $authorizate_paths = ['/admin','/jobs','/jobs/add','/users','/users/add'];
        $sessionUserId = $_SESSION['userId'] ?? null;

        if($path == "/login" && $sessionUserId){
            return new RedirectResponse('/admin');
        }else if(in_array($path,$authorizate_paths)){
            if(!$sessionUserId){
                return new RedirectResponse('/login');
            }
        }

        return $handler->handle($request);
    }
}
