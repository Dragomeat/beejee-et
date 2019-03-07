<?php

declare(strict_types=1);

namespace BeeJeeET\Application\Accounts;

use Psr\Container\ContainerInterface;
use BeeJeeET\Domain\Accounts\AuthService;
use BeeJeeET\Domain\Accounts\UserRepository;

class UserServiceFactory
{
    public function __invoke(ContainerInterface $container): UserService
    {
        return new UserService(
            $container->get(UserRepository::class),
            $container->get(AuthService::class),
            $container->get(UserAssembler::class)
        );
    }
}
