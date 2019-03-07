<?php

declare(strict_types=1);

namespace BeeJeeET\Infrastructure\Container;

use League\Container\Container;
use BeeJeeET\Domain\Accounts\AuthService;
use League\Container\ServiceProvider\AbstractServiceProvider;
use BeeJeeET\Infrastructure\Accounts\SessionAuthServiceFactory;

class AccountsProvider extends AbstractServiceProvider
{
    protected $provides = [
        AuthService::class,
    ];

    public function register(): void
    {
        /**
         * @var Container $container
         */
        $container = $this->container;

        $container->share(
            AuthService::class,
            [new SessionAuthServiceFactory, '__invoke']
        )->addArgument($container);
    }
}
