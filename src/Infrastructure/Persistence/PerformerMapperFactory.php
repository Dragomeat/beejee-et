<?php

declare(strict_types=1);

namespace BeeJeeET\Infrastructure\Persistence;

use Psr\Container\ContainerInterface;
use Zend\Hydrator\ReflectionHydrator;
use BeeJeeET\Infrastructure\ObjectHydrator;

class PerformerMapperFactory
{
    public function __invoke(ContainerInterface $container): PerformerMapper
    {
        $hydrator = new ObjectHydrator(
            $container->get(ReflectionHydrator::class),
            SimplePerformer::class
        );

        return new PerformerMapper($hydrator);
    }
}
