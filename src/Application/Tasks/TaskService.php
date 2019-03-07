<?php

declare(strict_types=1);

namespace BeeJeeET\Application\Tasks;

use BeeJeeET\Domain\Slice;
use BeeJeeET\Domain\Tasks\Task;
use BeeJeeET\Domain\Accounts\User;
use BeeJeeET\Domain\Tasks\TaskId;
use BeeJeeET\Domain\Tasks\TaskRepository;
use BeeJeeET\Domain\Accounts\AuthService;
use BeeJeeET\Domain\Tasks\TaskSpecificationFactory;
use BeeJeeET\Infrastructure\Persistence\SimplePerformer;

class TaskService
{
    /**
     * @var TaskRepository
     */
    private $tasks;

    /**
     * @var TaskSpecificationFactory
     */
    private $specificationFactory;

    /**
     * @var TaskAssembler
     */
    private $assembler;

    /**
     * @var AuthService
     */
    private $auth;

    public function __construct(
        TaskRepository $tasks,
        TaskSpecificationFactory $specificationFactory,
        TaskAssembler $assembler,
        AuthService $auth
    ) {
        $this->tasks = $tasks;
        $this->specificationFactory = $specificationFactory;
        $this->assembler = $assembler;
        $this->auth = $auth;
    }

    public function get(string $id): TaskDto
    {
        $task = $this->tasks->get(
            new TaskId($id)
        );

        return $this->assembler->toDto($task);
    }

    public function list(int $page, string $performer, string $status): SlicedTasksDto
    {
        $slice = new Slice(($page - 1) * 3, 3);

        $specification = null;

        if ($performer !== 'all') {
            $specification = $this->specificationFactory->createByPerformer($performer);
        }

        if ($status !== 'all') {
            $byStatus = $this->specificationFactory->createByStatus($status === 'completed');

            $specification = $specification !== null
                ? $specification->andSpecification($byStatus)
                : $byStatus;
        }

        $total = $this->tasks->count($specification);

        $tasks = $specification !== null
            ? $this->tasks->matching($slice, $specification)
            : $this->tasks->all($slice);

        $tasks = array_map(
            function (Task $task): TaskDto {
                return $this->assembler->toDto($task);
            },
            $tasks
        );

        return new SlicedTasksDto($total, $tasks);
    }

    public function complete(CompleteTaskDto $dto): TaskDto
    {
        $task = $this->tasks->get(
            new TaskId($dto->id)
        );

        $task->complete();

        $this->tasks->save($task);

        return $this->assembler->toDto($task);
    }

    public function activate(ActivateTaskDto $dto): TaskDto
    {
        $task = $this->tasks->get(
            new TaskId($dto->id)
        );

        $task->activate();

        $this->tasks->save($task);

        return $this->assembler->toDto($task);
    }

    public function create(CreateTaskDto $dto): TaskDto
    {
        /**
         * @var User $user
         */
        $user = $this->auth->getUser();

        $task = new Task(
            $this->tasks->getNextIdentity(),
            SimplePerformer::fromUser($user),
            $dto->goal
        );

        $this->tasks->save($task);

        return $this->assembler->toDto($task);
    }

    public function update(UpdateTaskDto $dto): TaskDto
    {
        $task = $this->tasks->get(
            new TaskId($dto->id)
        );

        $task->changeGoal($dto->goal);

        $this->tasks->save($task);

        return $this->assembler->toDto($task);
    }
}
