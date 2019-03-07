<?php

declare(strict_types=1);

use League\Route\Router;
use Psr\Container\ContainerInterface;
use BeeJeeET\Ui\Middleware\RequireAdmin;
use BeeJeeET\Ui\Middleware\RedirectIfAuth;
use BeeJeeET\Ui\Middleware\RedirectIfGuest;
use Zend\Diactoros\Response\RedirectResponse;

return function (ContainerInterface $container, Router $router): void {
    $authMiddleware = $container->get(RedirectIfGuest::class);
    $guestMiddleware = $container->get(RedirectIfAuth::class);
    $requireAdmin = $container->get(RequireAdmin::class);


    $router->get('/', function () {
        return new RedirectResponse('/tasks');
    });

    $router->get('/tasks', BeeJeeET\Ui\Actions\ListTasks::class);
    $router->post('/tasks', BeeJeeET\Ui\Actions\CreateTask::class);

    $router->get(
        '/tasks/{id}',
        BeeJeeET\Ui\Actions\ShowTask::class
    )->middlewares([$requireAdmin, $authMiddleware]);

    $router->post(
        '/tasks/{id}',
        BeeJeeET\Ui\Actions\UpdateTask::class
    )->middlewares([$requireAdmin, $authMiddleware]);

    $router->post(
        '/tasks/{id}/complete',
        BeeJeeET\Ui\Actions\CompleteTask::class
    )->middlewares([$requireAdmin, $authMiddleware]);

    $router->post(
        '/tasks/{id}/activate',
        BeeJeeET\Ui\Actions\ActivateTask::class
    )->middlewares([$requireAdmin, $authMiddleware]);

    $router->get('/login', BeeJeeET\Ui\Actions\ShowSignIn::class)->middleware($guestMiddleware);
    $router->post('/login', BeeJeeET\Ui\Actions\SignIn::class)->middleware($guestMiddleware);
    $router->post('/logout', BeeJeeET\Ui\Actions\Logout::class)->middleware($authMiddleware);
};
