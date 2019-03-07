<?php

declare(strict_types=1);

namespace BeeJeeET\Infrastructure\Routing;

use NDC\Csrf\CsrfMiddleware;
use Psr\Container\ContainerInterface;

class CsrfMiddlewareFactory
{
    public function __invoke(ContainerInterface $container): CsrfMiddleware
    {
        return new CsrfMiddleware($_SESSION, 200);
    }
}
