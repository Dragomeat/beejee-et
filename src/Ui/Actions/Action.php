<?php

declare(strict_types=1);

namespace BeeJeeET\Ui\Actions;

use Pagerfanta\Pagerfanta;
use Pagerfanta\Adapter\AdapterInterface;

class Action
{
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
