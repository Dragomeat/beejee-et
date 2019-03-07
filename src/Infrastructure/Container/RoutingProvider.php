<?php

declare(strict_types=1);

namespace BeeJeeET\Infrastructure\Container;

use NDC\Csrf\CsrfMiddleware;
use League\Container\Container;
use League\Route\Router as LeagueRouter;
use BeeJeeET\Infrastructure\Routing\RouterHandler;
use BeeJeeET\Infrastructure\Routing\RouterHandlerFactory;
use BeeJeeET\Infrastructure\Routing\LeagueRouterFactory;
use BeeJeeET\Infrastructure\Routing\CsrfMiddlewareFactory;
use League\Container\ServiceProvider\AbstractServiceProvider;

class RoutingProvider extends AbstractServiceProvider
{
    protected $provides = [
        RouterHandler::class,
        LeagueRouter::class,
        CsrfMiddleware::class,
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

        $container->share(
            CsrfMiddleware::class,
            [new CsrfMiddlewareFactory, '__invoke']
        )->addArgument($container);
    }
}
