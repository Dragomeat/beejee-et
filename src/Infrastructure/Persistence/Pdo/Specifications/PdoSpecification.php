<?php

declare(strict_types=1);

namespace BeeJeeET\Infrastructure\Persistence\Pdo\Specifications;

use BeeJeeET\Domain\Specifications\SpecificationInterface;

interface PdoSpecification extends SpecificationInterface
{
    public function toSqlClauses(): string;
}
