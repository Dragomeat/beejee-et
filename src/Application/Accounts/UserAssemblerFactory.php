<?php

declare(strict_types=1);

namespace BeeJeeET\Application\Accounts;

use BeeJeeET\Domain\Accounts\User;
use Zend\Hydrator\ReflectionHydrator;
use Psr\Container\ContainerInterface;
use BeeJeeET\Infrastructure\ObjectHydrator;

class UserAssemblerFactory
{
    public function __invoke(ContainerInterface $container): UserAssembler
    {
        $hydrator = new ObjectHydrator(
            $container->get(ReflectionHydrator::class),
            User::class
        );

        return new UserAssembler($hydrator);
    }
}
