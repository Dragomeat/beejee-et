<?php

declare(strict_types=1);

namespace BeeJeeET\Infrastructure\Routing;

use League\Route\Router as LeagueRouter;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class RouterHandler implements RequestHandlerInterface
{
    /**
     * @var LeagueRouter
     */
    private $router;

    public function __construct(LeagueRouter $router)
    {
        $this->router = $router;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        return $this->router->dispatch($request);
    }
}
