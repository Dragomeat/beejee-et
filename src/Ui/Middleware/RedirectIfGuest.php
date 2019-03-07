<?php

declare(strict_types=1);

namespace BeeJeeET\Ui\Middleware;

use BeeJeeET\Domain\Accounts\AuthService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\RedirectResponse;

class RedirectIfGuest implements MiddlewareInterface
{
    /**
     * @var AuthService
     */
    private $auth;

    public function __construct(AuthService $auth)
    {
        $this->auth = $auth;
    }

    /**
     * @param ServerRequestInterface $request
     * @param RequestHandlerInterface $handler
     * @return ResponseInterface
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        if (! $this->auth->isAuthenticated()) {
            return new RedirectResponse('/login');
        }

        return $handler->handle($request);
    }
}
