<?php

declare(strict_types=1);

namespace BeeJeeET\Infrastructure\Persistence;

use BeeJeeET\Domain\Tasks\Task;
use BeeJeeET\Infrastructure\Persistence\Pdo\Specifications\AbstractPdoSpecification;

class ByStatusTaskSpecification extends AbstractPdoSpecification
{
    /**
     * @var bool
     */
    private $isCompleted;

    public function __construct(bool $isCompleted)
    {
        $this->isCompleted = $isCompleted;
    }

    /**
     * @param mixed $object
     * @return bool
     */
    public function isSatisfiedBy($object): bool
    {
        return $object instanceof Task
            && $object->isCompleted() === $this->isCompleted;
    }

    public function toSqlClauses(): string
    {
        return sprintf(
            "`tasks`.`is_completed` = '%s'",
            (int)$this->isCompleted
        );
    }
}
