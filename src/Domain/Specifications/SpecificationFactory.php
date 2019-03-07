<?php

declare(strict_types=1);

namespace BeeJeeET\Domain\Specifications;

interface SpecificationFactory
{
    public function andSpecification(
        SpecificationInterface $one,
        SpecificationInterface $other
    ): SpecificationInterface;

    public function orSpecification(
        SpecificationInterface $one,
        SpecificationInterface $other
    ): SpecificationInterface;

    public function not(SpecificationInterface $specification): SpecificationInterface;
}
