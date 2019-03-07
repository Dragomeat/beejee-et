<?php

declare(strict_types=1);

namespace BeeJeeET\Ui\Actions;

use Valitron\Validator;
use League\Plates\Engine;
use Pagerfanta\Adapter\FixedAdapter;
use Psr\Http\Message\ResponseInterface;
use Zend\Diactoros\Response\HtmlResponse;
use BeeJeeET\Application\Tasks\TaskService;
use Psr\Http\Message\ServerRequestInterface;
use BeeJeeET\Application\Accounts\UserService;
use Zend\Diactoros\Response\RedirectResponse;

class ListTasks extends Action
{
    /**
     * @var TaskService
     */
    private $tasks;

    /**
     * @var UserService
     */
    private $users;

    /**
     * @var Engine
     */
    private $template;


    public function __construct(
        TaskService $tasks,
        UserService $users,
        Engine $template
    ) {
        $this->tasks = $tasks;
        $this->users = $users;
        $this->template = $template;
    }

    public function __invoke(ServerRequestInterface $request): ResponseInterface
    {
        $filters = array_merge(
            [
                'performer' => 'all',
                'status' => 'all',
                'page' => 1,
            ],
            $request->getQueryParams()
        );

        $validator = new Validator($filters);

        $validator->rule('in', 'status', ['all', 'active', 'completed']);

        if (!$validator->validate()) {
            return new RedirectResponse('/tasks');
        }

        ['page' => $page, 'performer' => $performer, 'status' => $status] = $filters;

        $page = (int) $page;

        $dto = $this->tasks->list($page, $performer, $status);
        $performers = $this->users->list();

        $adapter = new FixedAdapter($dto->total, $tasks = $dto->tasks);

        $pagerfanta = $this->pagerfanta($adapter, $page);

        $html = $this->template->render(
            'tasks::list',
            compact('tasks', 'performers', 'pagerfanta')
        );

        return new HtmlResponse($html);
    }
}
