<?php

declare(strict_types=1);

namespace BeeJeeET\Ui\Actions;

use Psr\Http\Message\ResponseInterface;
use BeeJeeET\Application\Tasks\TaskService;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\RedirectResponse;
use BeeJeeET\Application\Tasks\ActivateTaskDto;

class ActivateTask extends Action
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
        $referer = $this->getRefererOr($request, '/tasks');

        $this->tasks->activate(
            new ActivateTaskDto($args['id'])
        );

        return new RedirectResponse($referer);
    }
}
