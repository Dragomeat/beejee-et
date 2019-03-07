<?php

declare(strict_types=1);

namespace BeeJeeET\Application\Tasks;

use BeeJeeET\Domain\Tasks\Task;
use Psr\Container\ContainerInterface;
use Zend\Hydrator\ReflectionHydrator;
use BeeJeeET\Infrastructure\ObjectHydrator;

class TaskAssemblerFactory
{
    public function __invoke(ContainerInterface $container): TaskAssembler
    {
        $hydrator = new ObjectHydrator(
            $container->get(ReflectionHydrator::class),
            Task::class
        );

        return new TaskAssembler(
            $hydrator,
            $container->get(PerformerAssembler::class)
        );
    }
}
