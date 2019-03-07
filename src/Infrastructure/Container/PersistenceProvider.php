<?php

declare(strict_types=1);

namespace BeeJeeET\Infrastructure\Container;

use PDO;
use League\Container\Container;
use BeeJeeET\Domain\Tasks\TaskRepository;
use BeeJeeET\Domain\Tasks\TaskSpecificationFactory as TaskSpecificationFactoryInterface;
use BeeJeeET\Domain\Accounts\UserRepository;
use BeeJeeET\Infrastructure\Persistence\PdoFactory;
use BeeJeeET\Infrastructure\Persistence\UserMapper;
use BeeJeeET\Infrastructure\Persistence\UserMapperFactory;
use BeeJeeET\Infrastructure\Persistence\UserRepositoryFactory;
use BeeJeeET\Infrastructure\Persistence\TaskMapper;
use BeeJeeET\Infrastructure\Persistence\PerformerMapper;
use League\Container\ServiceProvider\AbstractServiceProvider;
use BeeJeeET\Infrastructure\Persistence\TaskMapperFactory;
use BeeJeeET\Infrastructure\Persistence\TaskRepositoryFactory;
use BeeJeeET\Infrastructure\Persistence\PerformerMapperFactory;
use BeeJeeET\Infrastructure\Persistence\TaskSpecificationFactory;

class PersistenceProvider extends AbstractServiceProvider
{
    protected $provides = [
        PDO::class,
        UserRepository::class,
        TaskRepository::class,
        UserMapper::class,
        TaskMapper::class,
        TaskSpecificationFactoryInterface::class,
        PerformerMapper::class,
    ];

    public function register(): void
    {
        /**
         * @var Container $container
         */
        $container = $this->container;

        $container->add(
            PDO::class,
            [new PdoFactory, '__invoke']
        )->addArgument($container);

        $container->add(
            UserRepository::class,
            [new UserRepositoryFactory, '__invoke']
        )->addArgument($container);

        $container->add(
            TaskRepository::class,
            [new TaskRepositoryFactory, '__invoke']
        )->addArgument($container);

        $container->add(
            UserMapper::class,
            [new UserMapperFactory, '__invoke']
        )->addArgument($container);

        $container->add(
            TaskMapper::class,
            [new TaskMapperFactory, '__invoke']
        )->addArgument($container);

        $container->add(
            TaskSpecificationFactoryInterface::class,
            TaskSpecificationFactory::class
        );

        $container->add(
            PerformerMapper::class,
            [new PerformerMapperFactory, '__invoke']
        )->addArgument($container);
    }
}
