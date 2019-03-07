<?php

declare(strict_types=1);

namespace BeeJeeET\Domain\Specifications;

class OrSpecification extends Specification
{
    /**
     * @var SpecificationInterface
     */
    private $one;

    /**
     * @var SpecificationInterface
     */
    private $other;

    public function __construct(SpecificationInterface $one, SpecificationInterface $other)
    {
        $this->one = $one;
        $this->other = $other;
    }

    /**
     * @param mixed $object
     * @return bool
     */
    public function isSatisfiedBy($object): bool
    {
        return $this->one->isSatisfiedBy($object)
            || $this->other->isSatisfiedBy($object);
    }
}
