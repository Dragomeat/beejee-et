<?php

declare(strict_types=1);

namespace BeeJeeET\Infrastructure\Persistence;

use Psr\Container\ContainerInterface;
use Zend\Hydrator\ReflectionHydrator;
use BeeJeeET\Infrastructure\ObjectHydrator;

class TaskMapperFactory
{
    public function __invoke(ContainerInterface $container): TaskMapper
    {
        $hydrator = new ObjectHydrator(
            $container->get(ReflectionHydrator::class),
            TaskProxy::class
        );

        return new TaskMapper(
            $hydrator,
            $container->get(PerformerMapper::class)
        );
    }
}
