<?php

declare(strict_types=1);

namespace BeeJeeET\Infrastructure\Template;

use League\Plates\Engine;
use BeeJeeET\Domain\Accounts\AuthService;
use League\Plates\Extension\ExtensionInterface;

class AuthExtension implements ExtensionInterface
{
    /**
     * @var AuthService
     */
    private $auth;

    public function __construct(AuthService $auth)
    {
        $this->auth = $auth;
    }

    public function register(Engine $engine): void
    {
        $engine->registerFunction('auth', [$this, 'getAuth']);
    }

    public function getAuth(): AuthService
    {
        return $this->auth;
    }
}
