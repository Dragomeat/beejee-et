<?php

declare(strict_types=1);

namespace BeeJeeET\Domain\Specifications;

abstract class Specification implements SpecificationInterface
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
