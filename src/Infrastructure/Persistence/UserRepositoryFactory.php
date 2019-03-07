<?php

declare(strict_types=1);

namespace BeeJeeET\Infrastructure\Persistence;

use PDO;
use Ramsey\Uuid\UuidFactory;
use Psr\Container\ContainerInterface;
use BeeJeeET\Domain\Accounts\UserRepository;
use BeeJeeET\Infrastructure\Persistence\Pdo\PdoUserRepository;

class UserRepositoryFactory
{
    public function __invoke(ContainerInterface $container): UserRepository
    {
        return new PdoUserRepository(
            $container->get(PDO::class),
            $container->get(UuidFactory::class),
            $container->get(UserMapper::class)
        );
    }
}
