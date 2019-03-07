<?php

declare(strict_types=1);

namespace BeeJeeET\Domain\Specifications;

interface SpecificationInterface
{
    /**
     * @param mixed $object
     * @return bool
     */
    public function isSatisfiedBy($object): bool;

    public function andSpecification(SpecificationInterface $specification): SpecificationInterface;

    public function orSpecification(SpecificationInterface $specification): SpecificationInterface;

    public function not(): SpecificationInterface;
}
