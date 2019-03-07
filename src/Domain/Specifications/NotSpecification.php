<?php

declare(strict_types=1);

namespace BeeJeeET\Domain\Specifications;

class NotSpecification extends Specification
{
    /**
     * @var SpecificationInterface
     */
    private $specification;

    public function __construct(SpecificationInterface $specification)
    {
        $this->specification = $specification;
    }

    /**
     * @param mixed $object
     * @return bool
     */
    public function isSatisfiedBy($object): bool
    {
        return !$this->specification->isSatisfiedBy($object);
    }
}
