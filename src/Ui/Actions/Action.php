<?php

declare(strict_types=1);

namespace BeeJeeET\Ui\Actions;

use Pagerfanta\Pagerfanta;
use Pagerfanta\Adapter\AdapterInterface;
use Psr\Http\Message\ServerRequestInterface;

class Action
{
    public function getRefererOr(
        ServerRequestInterface $request,
        string $default = '/'
    ): string {
        $headers = $request->getHeaders();

        return array_key_exists('referer', $headers)
            ? $headers['referer'][0]
            : $default;
    }

    public function pagerfanta(
        AdapterInterface $adapter,
        int $page,
        int $perPage = 3
    ): Pagerfanta {
        $pagerfanta = new Pagerfanta($adapter);

        $pagerfanta->setMaxPerPage($perPage);
        $pagerfanta->setCurrentPage($page);

        return $pagerfanta;
    }
}
