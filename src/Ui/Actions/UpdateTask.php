<?php

declare(strict_types=1);

namespace BeeJeeET\Ui\Actions;

use Psr\Http\Message\ResponseInterface;
use BeeJeeET\Application\Tasks\TaskService;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\RedirectResponse;
use BeeJeeET\Application\Tasks\UpdateTaskDto;
use BeeJeeET\Ui\InputFilters\UpdateTaskFilter;

class UpdateTask
{
    /**
     * @var UpdateTaskFilter
     */
    private $inputFilter;

    /**
     * @var TaskService
     */
    private $tasks;

    public function __construct(
        UpdateTaskFilter $inputFilter,
        TaskService $tasks
    ) {
        $this->inputFilter = $inputFilter;
        $this->tasks = $tasks;
    }

    public function __invoke(ServerRequestInterface $request, array $args): ResponseInterface
    {
        $this->inputFilter->setData(
            $request->getParsedBody()
        );

        if (! $this->inputFilter->isValid()) {
            return new RedirectResponse('/tasks');
        }

        ['goal' => $goal] = $request->getParsedBody();

        $this->tasks->update(
            new UpdateTaskDto($args['id'], $goal)
        );

        return new RedirectResponse('/tasks');
    }
}
