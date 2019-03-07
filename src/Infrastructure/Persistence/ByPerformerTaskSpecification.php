<?php

declare(strict_types=1);

namespace BeeJeeET\Infrastructure\Persistence;

use BeeJeeET\Domain\Tasks\Task;
use BeeJeeET\Infrastructure\Persistence\Pdo\Specifications\AbstractPdoSpecification;

class ByPerformerTaskSpecification extends AbstractPdoSpecification
{
    /**
     * @var string
     */
    private $performer;

    public function __construct(string $performer)
    {
        $this->performer = $performer;
    }

    /**
     * @param mixed $object
     * @return bool
     */
    public function isSatisfiedBy($object): bool
    {
        return $object instanceof Task
            && $object->getPerformer()->getId() === $this->performer;
    }

    public function toSqlClauses(): string
    {
        return sprintf("`tasks`.`performer_id` = '%s'", $this->performer);
    }
}
