<?php

declare(strict_types=1);

namespace BeeJeeET\Ui\Actions;

use Psr\Http\Message\ResponseInterface;
use BeeJeeET\Application\Tasks\TaskService;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\RedirectResponse;
use BeeJeeET\Application\Tasks\CompleteTaskDto;

class CompleteTask
{
    /**
     * @var TaskService
     */
    private $tasks;

    public function __construct(TaskService $tasks)
    {
        $this->tasks = $tasks;
    }

    public function __invoke(ServerRequestInterface $request, array $args): ResponseInterface
    {
        $this->tasks->complete(
            new CompleteTaskDto($args['id'])
        );

        return new RedirectResponse('/tasks');
    }
}
