<?php

declare(strict_types=1);

namespace BeeJeeET\Infrastructure\Persistence;

use PDO;
use BeeJeeET\Domain\Tasks\TaskRepository;
use Psr\Container\ContainerInterface;
use BeeJeeET\Infrastructure\Persistence\Pdo\PdoTaskRepository;

class TaskRepositoryFactory
{
    public function __invoke(ContainerInterface $container): TaskRepository
    {
        return new PdoTaskRepository(
            $container->get(PDO::class),
            $container->get(TaskMapper::class)
        );
    }
}
