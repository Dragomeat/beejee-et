<?php

declare(strict_types=1);

namespace BeeJeeET\Ui\Actions;

use BeeJeeET\Domain\Accounts\AuthService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\RedirectResponse;

class Logout
{
    /**
     * @var AuthService
     */
    private $auth;

    public function __construct(AuthService $auth)
    {
        $this->auth = $auth;
    }

    public function __invoke(ServerRequestInterface $request): ResponseInterface
    {
        $this->auth->logout();

        return new RedirectResponse('/login');
    }
}
