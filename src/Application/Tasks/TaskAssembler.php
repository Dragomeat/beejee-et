<?php

declare(strict_types=1);

namespace BeeJeeET\Application\Tasks;

use BeeJeeET\Domain\Tasks\Task;
use BeeJeeET\Domain\Tasks\TaskId;
use BeeJeeET\Infrastructure\ObjectHydrator;

class TaskAssembler
{
    /**
     * @var ObjectHydrator
     */
    private $hydrator;

    /**
     * @var PerformerAssembler
     */
    private $performerAssembler;

    public function __construct(
        ObjectHydrator $hydrator,
        PerformerAssembler $performerAssembler
    ) {
        $this->hydrator = $hydrator;
        $this->performerAssembler = $performerAssembler;
    }

    public function toDto(Task $task): TaskDto
    {
        return new TaskDto(
            (string)$task->getId(),
            $this->performerAssembler->toDto($task->getPerformer()),
            $task->getGoal(),
            $task->isCompleted()
        );
    }

    public function toEntity(TaskDto $dto): Task
    {
        /**
         * @var Task $task
         */
        $task = $this->hydrator->hydrate(
            [
                'id' => new TaskId($dto->id),
                'performer' => $this->performerAssembler->toEntity($dto->performer),
                'goal' => $dto->goal,
                'isCompleted' => $dto->isCompleted,
            ]
        );

        return $task;
    }
}
