<?php

declare(strict_types=1);

namespace BeeJeeET\Application\Tasks;

use BeeJeeET\Domain\Tasks\TaskRepository;
use Psr\Container\ContainerInterface;
use BeeJeeET\Domain\Accounts\AuthService;
use BeeJeeET\Domain\Tasks\TaskSpecificationFactory;

class TaskServiceFactory
{
    public function __invoke(ContainerInterface $container): TaskService
    {
        return new TaskService(
            $container->get(TaskRepository::class),
            $container->get(TaskSpecificationFactory::class),
            $container->get(TaskAssembler::class),
            $container->get(AuthService::class)
        );
    }
}
