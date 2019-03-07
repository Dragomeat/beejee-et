<?php

declare(strict_types=1);

namespace BeeJeeET\Infrastructure\Container;

use League\Plates\Engine;
use League\Container\Container;
use BeeJeeET\Infrastructure\Template\EngineFactory;
use League\Container\ServiceProvider\AbstractServiceProvider;

class TemplateProvider extends AbstractServiceProvider
{
    protected $provides = [
        Engine::class,
    ];

    public function register(): void
    {
        /**
         * @var Container $container
         */
        $container = $this->container;

        $container->share(
            Engine::class,
            [new EngineFactory, '__invoke']
        )->addArgument($container);
    }
}
