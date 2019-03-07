<?php

declare(strict_types=1);

namespace BeeJeeET\Infrastructure\Persistence\Pdo\Specifications;

use BeeJeeET\Domain\Specifications\SpecificationInterface;

abstract class AbstractPdoSpecification implements PdoSpecification
{
    public function andSpecification(SpecificationInterface $specification): SpecificationInterface
    {
        return new AndSpecification($this, $specification);
    }

    public function orSpecification(SpecificationInterface $specification): SpecificationInterface
    {
        return new OrSpecification($this, $specification);
    }

    public function not(): SpecificationInterface
    {
        return new NotSpecification($this);
    }
}
