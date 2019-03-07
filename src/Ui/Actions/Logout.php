<?php

declare(strict_types=1);

namespace BeeJeeET\Ui\Actions;

use BeeJeeET\Domain\Accounts\AuthService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\RedirectResponse;

class Logout implements RequestHandlerInterface
{

    /**
     * @var AuthService
     */
    private $auth;

    public function __construct(AuthService $auth)
    {
        $this->auth = $auth;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $this->auth->logout();

        return new RedirectResponse('/login');
    }
}
