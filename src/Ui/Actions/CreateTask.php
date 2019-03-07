<?php

declare(strict_types=1);

namespace BeeJeeET\Ui\Actions;

use Psr\Http\Message\ResponseInterface;
use BeeJeeET\Domain\Accounts\AuthService;
use BeeJeeET\Application\Tasks\TaskService;
use BeeJeeET\Application\Accounts\SignUpDto;
use BeeJeeET\Application\Accounts\UserService;
use BeeJeeET\Application\Tasks\CreateTaskDto;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\RedirectResponse;

class CreateTask implements RequestHandlerInterface
{
    /**
     * @var UserService
     */
    private $users;

    /**
     * @var TaskService
     */
    private $tasks;

    /**
     * @var AuthService
     */
    private $auth;

    public function __construct(
        UserService $users,
        TaskService $tasks,
        AuthService $auth
    ) {
        $this->users = $users;
        $this->tasks = $tasks;
        $this->auth = $auth;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        ['goal' => $goal] = $request->getParsedBody();

        if (!$this->auth->isAuthenticated()) {
            ['name' => $name, 'email' => $email] = $request->getParsedBody();

            $this->users->signUp(
                new SignUpDto($name, $email)
            );
        }

        $this->tasks->create(
            new CreateTaskDto($goal)
        );

        return new RedirectResponse('/tasks');
    }
}
