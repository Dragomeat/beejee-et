<?php

declare(strict_types=1);

namespace BeeJeeET\Domain\Tasks;

use BeeJeeET\Domain\Slice;
use BeeJeeET\Domain\Specifications\SpecificationInterface;

interface TaskRepository
{
    public function getNextIdentity(): TaskId;

    /**
     * @param Slice $slice
     * @return Task[]
     */
    public function all(Slice $slice): array;

    /**
     * @param Slice $slice
     * @param SpecificationInterface $specification
     * @return Task[]
     */
    public function matching(
        Slice $slice,
        SpecificationInterface $specification
    ): array;

    public function count(?SpecificationInterface $specification = null): int;

    /**
     * @param  TaskId $id
     * @throws TaskNotFound
     * @return Task
     */
    public function get(TaskId $id): Task;

    public function save(Task $task): void;
}
