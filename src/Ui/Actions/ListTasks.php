<?php

declare(strict_types=1);

namespace BeeJeeET\Ui\Actions;

use League\Plates\Engine;
use Pagerfanta\Adapter\FixedAdapter;
use Psr\Http\Message\ResponseInterface;
use Zend\Diactoros\Response\HtmlResponse;
use BeeJeeET\Application\Tasks\TaskService;
use Psr\Http\Message\ServerRequestInterface;
use BeeJeeET\Application\Tasks\ListTasksDto;
use BeeJeeET\Ui\InputFilters\ListTasksFilter;
use BeeJeeET\Application\Accounts\UserService;
use Zend\Diactoros\Response\RedirectResponse;

class ListTasks extends Action
{
    /**
     * @var ListTasksFilter
     */
    private $inputFilter;

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
        ListTasksFilter $inputFilter,
        TaskService $tasks,
        UserService $users,
        Engine $template
    ) {
        $this->inputFilter = $inputFilter;
        $this->tasks = $tasks;
        $this->users = $users;
        $this->template = $template;
    }

    public function __invoke(ServerRequestInterface $request): ResponseInterface
    {
        $query = $request->getQueryParams();

        $filters = [
            'status' => $query['status'] ?? 'all',
            'page' => (int)($query['page'] ?? 1),
            'performer' => !empty($query['performer'])
                ? $query['performer']
                : null,
        ];

        $this->inputFilter->setData($filters);

        if (!$this->inputFilter->isValid()) {
            return new RedirectResponse('/tasks');
        }

        $dto = $this->tasks->list(
            new ListTasksDto(
                $filters['page'],
                $filters['performer'] ?? 'all',
                $filters['status']
            )
        );

        $performers = $this->users->list();

        $adapter = new FixedAdapter($dto->total, $tasks = $dto->tasks);

        $pagerfanta = $this->pagerfanta($adapter, $filters['page']);

        $routeGenerator = function (int $page) use ($filters): string {
            $query = array_merge(
                $filters,
                [
                    'page' => $page,
                ]
            );

            return '?' . http_build_query($query);
        };

        $html = $this->template->render(
            'tasks::list',
            compact(
                'tasks',
                'performers',
                'filters',
                'pagerfanta',
                'routeGenerator'
            )
        );

        return new HtmlResponse($html);
    }
}
