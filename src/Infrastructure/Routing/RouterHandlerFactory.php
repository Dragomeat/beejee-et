<?php

declare(strict_types=1);

namespace BeeJeeET\Infrastructure\Routing;

use League\Route\Router as LeagueRouter;
use Psr\Container\ContainerInterface;

class RouterHandlerFactory
{
    public function __invoke(ContainerInterface $container): RouterHandler
    {
        return new RouterHandler(
            $container->get(LeagueRouter::class)
        );
    }
}
