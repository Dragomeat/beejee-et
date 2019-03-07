<?php

declare(strict_types=1);

namespace BeeJeeET\Infrastructure\Routing;

use NDC\Csrf\CsrfMiddleware;
use BeeJeeET\Ui\Middleware\DelegateMiddleware;
use Psr\Container\ContainerInterface;
use BeeJeeET\Ui\Middleware\StartSession;
use League\Route\Router as LeagueRouter;
use League\Route\Strategy\ApplicationStrategy;

class LeagueRouterFactory
{
    public function __invoke(ContainerInterface $container): LeagueRouter
    {
        $router = new LeagueRouter();

        $strategy = new ApplicationStrategy();
        $strategy->setContainer($container);

        $router->setStrategy($strategy);

        $router->middleware(new StartSession);

        $router->middleware(
            new DelegateMiddleware($container, CsrfMiddleware::class)
        );

        // TODO
        (require __DIR__ . '/../../../config/routes.php')($container, $router);

        return $router;
    }
}
