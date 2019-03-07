<?php

declare(strict_types=1);

namespace BeeJeeET\Ui\Actions;

use League\Plates\Engine;
use Psr\Http\Message\ResponseInterface;
use Zend\Diactoros\Response\HtmlResponse;
use BeeJeeET\Application\Tasks\TaskService;
use Psr\Http\Message\ServerRequestInterface;

class ShowTask
{
    /**
     * @var TaskService
     */
    private $tasks;

    /**
     * @var Engine
     */
    private $template;

    public function __construct(
        TaskService $tasks,
        Engine $template
    ) {
        $this->tasks = $tasks;
        $this->template = $template;
    }

    public function __invoke(ServerRequestInterface $request, array $args): ResponseInterface
    {
        $task = $this->tasks->get($args['id']);

        $html = $this->template->render(
            'tasks::show',
            compact('task')
        );

        return new HtmlResponse($html);
    }
}
