<?php

declare(strict_types=1);

namespace BeeJeeET\Infrastructure\Persistence;

use BeeJeeET\Domain\Accounts\User;
use Psr\Container\ContainerInterface;
use Zend\Hydrator\ReflectionHydrator;
use BeeJeeET\Infrastructure\ObjectHydrator;

class UserMapperFactory
{
    public function __invoke(ContainerInterface $container): UserMapper
    {
        $hydrator = new ObjectHydrator(
            $container->get(ReflectionHydrator::class),
            User::class
        );

        return new UserMapper($hydrator);
    }
}
