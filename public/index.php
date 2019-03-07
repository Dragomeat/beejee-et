<?php

declare(strict_types=1);

error_reporting(E_ALL);
ini_set('display_errors', '1');

use League\Container\Container;
use League\Container\ReflectionContainer;
use Psr\Http\Message\ResponseInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\ServerRequestFactory;
use BeeJeeET\Infrastructure\Routing\RouterHandler;
use Zend\HttpHandlerRunner\Emitter\SapiEmitter;
use Zend\HttpHandlerRunner\RequestHandlerRunner;
use BeeJeeET\Infrastructure\Container\RoutingProvider;
use BeeJeeET\Infrastructure\Container\ApplicationProvider;
use BeeJeeET\Infrastructure\Container\PersistenceProvider;
use BeeJeeET\Infrastructure\Container\TemplateProvider;
use BeeJeeET\Infrastructure\Container\AccountsProvider;

require __DIR__ . '/../vendor/autoload.php';

$container = new Container;

$container->delegate(new ReflectionContainer);

$config = require __DIR__ . '/../config/config.php';

$container->add('config', $config);

$container->addServiceProvider(ApplicationProvider::class);
$container->addServiceProvider(PersistenceProvider::class);
$container->addServiceProvider(RoutingProvider::class);
$container->addServiceProvider(TemplateProvider::class);
$container->addServiceProvider(AccountsProvider::class);

$runner = new RequestHandlerRunner(
    $container->get(RouterHandler::class),
    new SapiEmitter(),
    [ServerRequestFactory::class, 'fromGlobals'],
    function (Throwable $e): ResponseInterface {
        // TODO
        return new HtmlResponse('<h1>Something went wrong.</h1>');
    }
);

$runner->run();



