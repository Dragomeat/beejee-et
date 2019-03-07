<?php

declare(strict_types=1);

namespace BeeJeeET\Infrastructure\Template;

use League\Plates\Engine;
use NDC\Csrf\CsrfMiddleware;
use League\Plates\Extension\ExtensionInterface;

class CsrfExtension implements ExtensionInterface
{
    /**
     * @var CsrfMiddleware
     */
    private $middleware;

    public function __construct(CsrfMiddleware $middleware)
    {
        $this->middleware = $middleware;
    }

    public function register(Engine $engine): void
    {
        $engine->registerFunction('csrf', [$this, 'getCsrf']);
    }

    public function getCsrf(): CsrfMiddleware
    {
        return $this->middleware;
    }
}
