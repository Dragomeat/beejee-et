<?php

declare(strict_types=1);

namespace BeeJeeET\Infrastructure\Persistence\Pdo\Specifications;

use BeeJeeET\Domain\Specifications\SpecificationInterface;

class SpecificationFactory
{
    public function andSpecification(
        SpecificationInterface $one,
        SpecificationInterface $other
    ): SpecificationInterface {
        return new AndSpecification($one, $other);
    }

    public function orSpecification(
        SpecificationInterface $one,
        SpecificationInterface $other
    ): SpecificationInterface {
        return new OrSpecification($one, $other);
    }

    public function not(
        SpecificationInterface $specification
    ): SpecificationInterface {
        return new NotSpecification($specification);
    }
}
