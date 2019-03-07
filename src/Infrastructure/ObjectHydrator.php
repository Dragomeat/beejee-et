<?php

declare(strict_types=1);

namespace BeeJeeET\Infrastructure;

use ReflectionClass;
use ReflectionException;
use Zend\Hydrator\HydratorInterface;

class ObjectHydrator
{
    /**
     * @var HydratorInterface
     */
    private $hydrator;

    /**
     * @var ReflectionClass
     */
    private $reflection;

    /**
     * @param HydratorInterface $hydrator
     * @param object|class-string $class
     * @throws ReflectionException
     */
    public function __construct(HydratorInterface $hydrator, $class)
    {
        $this->hydrator = $hydrator;
        $this->reflection = new ReflectionClass($class);
    }

    public function extract(object $object): array
    {
        return $this->hydrator->extract($object);
    }

    public function hydrate(array $values): object
    {
        return $this->hydrator->hydrate(
            $values,
            $this->reflection->newInstanceWithoutConstructor()
        );
    }
}
