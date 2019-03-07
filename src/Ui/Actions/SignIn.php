<?php

declare(strict_types=1);

namespace BeeJeeET\Ui\Actions;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\RedirectResponse;
use BeeJeeET\Application\Accounts\UserService;
use BeeJeeET\Application\Accounts\SignInUserDto;

class SignIn implements RequestHandlerInterface
{
    /**
     * @var UserService
     */
    private $users;

    public function __construct(UserService $users)
    {
        $this->users = $users;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        ['email' => $email, 'password' => $password] = $request->getParsedBody();

        $this->users->signIn(
            new SignInUserDto($email, $password)
        );

        return new RedirectResponse('/tasks');
    }
}
