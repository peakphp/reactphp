<?php

namespace App\Http\Controller;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as Handler;
use Zend\Diactoros\Response\HtmlResponse;

class NotFoundController implements Handler
{
    /**
     * Handle the request and return a response.
     * @param Request $request
     * @return Response
     */
    public function handle(Request $request): Response
    {
        return new HtmlResponse('404 - Page not found', 404);
    }
}
