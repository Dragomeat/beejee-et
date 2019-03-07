<?php

declare(strict_types=1);

namespace BeeJeeET\Domain\Tasks;

use BeeJeeET\Domain\Specifications\SpecificationFactory;
use BeeJeeET\Domain\Specifications\SpecificationInterface;

interface TaskSpecificationFactory extends SpecificationFactory
{
    public function createByPerformer(string $id): SpecificationInterface;

    public function createByStatus(bool $isCompleted): SpecificationInterface;
}
