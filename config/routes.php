<?php

declare(strict_types=1);

use League\Route\Router;
use Psr\Container\ContainerInterface;
use BeeJeeET\Ui\Middleware\RedirectIfAuth;
use BeeJeeET\Ui\Middleware\RedirectIfGuest;

return function (ContainerInterface $container, Router $router): void {
    $authMiddleware = $container->get(RedirectIfGuest::class);
    $guestMiddleware = $container->get(RedirectIfAuth::class);

    $router->get('/tasks', BeeJeeET\Ui\Actions\ListTasks::class);
    $router->post('/tasks', 'BeeJeeET\Ui\Actions\CreateTask::handle');
    $router->get('/tasks/{id}', BeeJeeET\Ui\Actions\ShowTask::class)->middleware($authMiddleware);
    $router->post('/tasks/{id}', BeeJeeET\Ui\Actions\UpdateTask::class)->middleware($authMiddleware);
    $router->post('/tasks/{id}/complete', BeeJeeET\Ui\Actions\CompleteTask::class)
        ->middleware($authMiddleware);
    $router->post('/tasks/{id}/activate', BeeJeeET\Ui\Actions\ActivateTask::class)
        ->middleware($authMiddleware);

    $router->get('/login', 'BeeJeeET\Ui\Actions\ShowSignIn::handle')->middleware($guestMiddleware);
    $router->post('/login', 'BeeJeeET\Ui\Actions\SignIn::handle')->middleware($guestMiddleware);
    $router->post('/logout', 'BeeJeeET\Ui\Actions\Logout::handle')->middleware($authMiddleware);
};
