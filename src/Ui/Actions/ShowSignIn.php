<?php

declare(strict_types=1);

namespace BeeJeeET\Ui\Actions;

use League\Plates\Engine;
use Psr\Http\Message\ResponseInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class ShowSignIn implements RequestHandlerInterface
{
    /**
     * @var Engine
     */
    private $template;

    public function __construct(Engine $template)
    {
        $this->template = $template;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $html = $this->template->render('login');

        return new HtmlResponse($html);
    }
}
