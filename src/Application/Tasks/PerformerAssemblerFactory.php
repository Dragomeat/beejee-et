<?php

declare(strict_types=1);

namespace BeeJeeET\Application\Tasks;

use Zend\Hydrator\ReflectionHydrator;
use Psr\Container\ContainerInterface;
use BeeJeeET\Infrastructure\ObjectHydrator;
use BeeJeeET\Infrastructure\Persistence\SimplePerformer;

class PerformerAssemblerFactory
{
    public function __invoke(ContainerInterface $container): PerformerAssembler
    {
        $hydrator = new ObjectHydrator(
            $container->get(ReflectionHydrator::class),
            SimplePerformer::class
        );

        return new PerformerAssembler($hydrator);
    }
}
