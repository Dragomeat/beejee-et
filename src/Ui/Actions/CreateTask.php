<?php

declare(strict_types=1);

namespace BeeJeeET\Ui\Actions;

use BeeJeeET\Ui\InputFilters\CreateTaskFilter;
use Psr\Http\Message\ResponseInterface;
use BeeJeeET\Domain\Accounts\AuthService;
use BeeJeeET\Application\Tasks\TaskService;
use BeeJeeET\Application\Accounts\SignUpDto;
use BeeJeeET\Application\Accounts\UserService;
use BeeJeeET\Application\Tasks\CreateTaskDto;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\RedirectResponse;

class CreateTask
{
    /**
     * @var CreateTaskFilter
     */
    private $inputFilter;

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
        CreateTaskFilter $inputFilter,
        UserService $users,
        TaskService $tasks,
        AuthService $auth
    ) {
        $this->inputFilter = $inputFilter;
        $this->users = $users;
        $this->tasks = $tasks;
        $this->auth = $auth;
    }

    public function __invoke(ServerRequestInterface $request): ResponseInterface
    {
        $this->inputFilter->setData(
            $request->getParsedBody()
        );

        if (! $this->inputFilter->isValid()) {
            return new RedirectResponse('/tasks');
        }

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
