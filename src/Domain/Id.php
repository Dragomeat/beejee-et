<?php

declare(strict_types=1);

namespace BeeJeeET\Domain;

abstract class Id
{
    /**
     * @var string
     */
    private $value;

    public function __construct(string $value)
    {
        $this->value = $value;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function equals(Id $id): bool
    {
        return $this->getValue() === $id->getValue();
    }

    public function __toString(): string
    {
        return $this->getValue();
    }
}
