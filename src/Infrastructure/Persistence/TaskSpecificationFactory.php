<?php

declare(strict_types=1);

namespace BeeJeeET\Infrastructure\Persistence;

use BeeJeeET\Domain\Specifications\SpecificationInterface;
use BeeJeeET\Domain\Tasks\TaskSpecificationFactory as TaskSpecificationFactoryInterface;
use BeeJeeET\Infrastructure\Persistence\Pdo\Specifications\SpecificationFactory;

class TaskSpecificationFactory extends SpecificationFactory implements TaskSpecificationFactoryInterface
{
    public function createByPerformer(string $performer): SpecificationInterface
    {
        return new ByPerformerTaskSpecification($performer);
    }

    public function createByStatus(bool $isCompleted): SpecificationInterface
    {
        return new ByStatusTaskSpecification($isCompleted);
    }
}
