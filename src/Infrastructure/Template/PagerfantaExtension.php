<?php

declare(strict_types=1);

namespace BeeJeeET\Infrastructure\Template;

use League\Plates\Engine;
use Pagerfanta\Pagerfanta;
use Pagerfanta\View\ViewInterface;
use Pagerfanta\View\TwitterBootstrap4View;
use League\Plates\Extension\ExtensionInterface;

class PagerfantaExtension implements ExtensionInterface
{
    public function register(Engine $engine): void
    {
        $engine->registerFunction('pagerfanta', [$this, 'render']);
    }

    public function render(
        Pagerfanta $pagerfanta,
        ?callable $routeGenerator = null,
        string $template = TwitterBootstrap4View::class
    ): string {
        if ($pagerfanta->getNbResults() === 0) {
            return '';
        }

        /**
         * @var ViewInterface $template
         */
        $template = new $template();

        return $template->render(
            $pagerfanta,
            $routeGenerator ?? function (int $page): string {
                return '?page=' . $page;
            },
            ['proximity' => 3]
        );
    }
}
