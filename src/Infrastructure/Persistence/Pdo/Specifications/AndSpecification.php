<?php

declare(strict_types=1);

namespace BeeJeeET\Infrastructure\Persistence\Pdo\Specifications;

use BeeJeeET\Domain\Specifications\SpecificationInterface;

class AndSpecification extends AbstractPdoSpecification
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
            && $this->other->isSatisfiedBy($object);
    }

    public function toSqlClauses(): string
    {
        if (!$this->one instanceof PdoSpecification
            || !$this->other instanceof PdoSpecification
        ) {
            return '';
        }

        return sprintf(
            '%s AND %s',
            $this->one->toSqlClauses(),
            $this->other->toSqlClauses()
        );
    }
}
