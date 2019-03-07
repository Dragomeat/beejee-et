<?php

declare(strict_types=1);

namespace BeeJeeET\Infrastructure\Accounts;

use Psr\Container\ContainerInterface;
use BeeJeeET\Domain\Accounts\UserRepository;

class SessionAuthServiceFactory
{
    public function __invoke(ContainerInterface $container): SessionAuthService
    {
        return new SessionAuthService(
            $container->get(UserRepository::class)
        );
    }
}
