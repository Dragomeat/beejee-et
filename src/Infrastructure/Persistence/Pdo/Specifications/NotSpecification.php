<?php

declare(strict_types=1);

namespace BeeJeeET\Infrastructure\Persistence\Pdo\Specifications;

use BeeJeeET\Domain\Specifications\SpecificationInterface;

class NotSpecification extends AbstractPdoSpecification
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
        return ! $this->specification->isSatisfiedBy($object);
    }

    public function toSqlClauses(): string
    {
        if (!$this->specification instanceof PdoSpecification) {
            return '';
        }

        return sprintf(
            'NOT %s',
            $this->specification->toSqlClauses()
        );
    }
}
