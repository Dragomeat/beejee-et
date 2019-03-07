<?php

declare(strict_types=1);

namespace BeeJeeET\Infrastructure\Persistence;

use BeeJeeET\Domain\Tasks\Task;
use BeeJeeET\Domain\Tasks\TaskId;
use BeeJeeET\Infrastructure\ObjectHydrator;

class TaskMapper
{
    /**
     * @var ObjectHydrator
     */
    private $hydrator;

    /**
     * @var PerformerMapper
     */
    private $performerMapper;

    public function __construct(
        ObjectHydrator $hydrator,
        PerformerMapper $performerMapper
    ) {
        $this->hydrator = $hydrator;
        $this->performerMapper = $performerMapper;
    }

    public function toArray(Task $task): array
    {
        $values = $this->hydrator->extract($task);

        $performer = $this->performerMapper->toArray($values['performer']);

        return [
            'id' => (string)$values['id'],
            'performer_id' => $performer['id'],
            'performer' => $performer,
            'goal' => $values['goal'],
            'is_completed' => (int)$values['isCompleted'],
        ];
    }

    public function toEntity(array $values): Task
    {
        $performer = [
            'id' => $values['performer_id'],
            'name' => $values['name'],
            'email' => $values['email'],
        ];

        $values = [
            'id' => new TaskId($values['id']),
            'performer' => $this->performerMapper->toEntity($performer),
            'goal' => $values['goal'],
            'isCompleted' => (bool)$values['is_completed'],
        ];

        /**
         * @var Task $task
         */
        $task = $this->hydrator->hydrate($values);

        return $task;
    }
}
