<?php

declare(strict_types=1);

namespace BeeJeeET\Infrastructure\Container;

use League\Container\Container;
use League\Route\Router as LeagueRouter;
use BeeJeeET\Infrastructure\Routing\RouterHandler;
use BeeJeeET\Infrastructure\Routing\RouterHandlerFactory;
use BeeJeeET\Infrastructure\Routing\LeagueRouterFactory;
use League\Container\ServiceProvider\AbstractServiceProvider;

class RoutingProvider extends AbstractServiceProvider
{
    protected $provides = [
        RouterHandler::class,
        LeagueRouter::class
    ];

    public function register(): void
    {
        /**
         * @var Container $container
         */
        $container = $this->container;

        $container->add(
            RouterHandler::class,
            [new RouterHandlerFactory, '__invoke']
        )->addArgument($container);

        $container->add(
            LeagueRouter::class,
            [new LeagueRouterFactory, '__invoke']
        )->addArgument($container);
    }
}
