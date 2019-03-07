<?php

declare(strict_types=1);

namespace BeeJeeET\Infrastructure\Template;

use League\Plates\Engine;
use Psr\Container\ContainerInterface;

class EngineFactory
{
    public function __invoke(ContainerInterface $container): Engine
    {
        $engine = new Engine(__DIR__.'/../../../resources/views');

        $engine->loadExtension(
            $container->get(AuthExtension::class)
        );

        $engine->loadExtension(
            $container->get(PagerfantaExtension::class)
        );

        $engine->loadExtension(
            $container->get(CsrfExtension::class)
        );

        $engine->addFolder('tasks', __DIR__.'/../../../resources/views/tasks');

        return $engine;
    }
}
