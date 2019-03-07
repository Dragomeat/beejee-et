<?php

declare(strict_types=1);

namespace BeeJeeET\Infrastructure\Container;

use League\Container\Container;
use BeeJeeET\Application\Accounts\UserService;
use BeeJeeET\Application\Tasks\TaskService;
use BeeJeeET\Application\Accounts\UserAssembler;
use BeeJeeET\Application\Tasks\TaskAssembler;
use BeeJeeET\Application\Tasks\PerformerAssembler;
use BeeJeeET\Application\Tasks\TaskServiceFactory;
use BeeJeeET\Application\Accounts\UserServiceFactory;
use BeeJeeET\Application\Tasks\TaskAssemblerFactory;
use BeeJeeET\Application\Accounts\UserAssemblerFactory;
use BeeJeeET\Application\Tasks\PerformerAssemblerFactory;
use League\Container\ServiceProvider\AbstractServiceProvider;

class ApplicationProvider extends AbstractServiceProvider
{
    protected $provides = [
        UserService::class,
        TaskService::class,
        UserAssembler::class,
        TaskAssembler::class,
        PerformerAssembler::class,
    ];

    public function register(): void
    {
        /**
         * @var Container $container
         */
        $container = $this->container;

        $container->add(
            TaskService::class,
            [new TaskServiceFactory, '__invoke']
        )->addArgument($container);

        $container->add(
            UserService::class,
            [new UserServiceFactory, '__invoke']
        )->addArgument($container);

        $container->add(
            TaskAssembler::class,
            [new TaskAssemblerFactory, '__invoke']
        )->addArgument($container);

        $container->add(
            UserAssembler::class,
            [new UserAssemblerFactory, '__invoke']
        )->addArgument($container);

        $container->add(
            PerformerAssembler::class,
            [new PerformerAssemblerFactory, '__invoke']
        )->addArgument($container);
    }
}
