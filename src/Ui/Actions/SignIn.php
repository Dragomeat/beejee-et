<?php

declare(strict_types=1);

namespace BeeJeeET\Ui\Actions;

use Psr\Http\Message\ResponseInterface;
use BeeJeeET\Ui\InputFilters\SignInFilter;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\RedirectResponse;
use BeeJeeET\Application\Accounts\UserService;
use BeeJeeET\Application\Accounts\SignInUserDto;

class SignIn
{
    /**
     * @var SignInFilter
     */
    private $inputFilter;

    /**
     * @var UserService
     */
    private $users;

    public function __construct(
        SignInFilter $inputFilter,
        UserService $users
    ) {
        $this->inputFilter = $inputFilter;
        $this->users = $users;
    }

    public function __invoke(ServerRequestInterface $request): ResponseInterface
    {
        $this->inputFilter->setData(
            $request->getParsedBody()
        );

        if (! $this->inputFilter->isValid()) {
            return new RedirectResponse('/login');
        }

        ['email' => $email, 'password' => $password] = $request->getParsedBody();

        $this->users->signIn(
            new SignInUserDto($email, $password)
        );

        return new RedirectResponse('/tasks');
    }
}
