<?php

declare(strict_types=1);

namespace BeeJeeET\Ui\Actions;

use Pagerfanta\Pagerfanta;
use Pagerfanta\Adapter\AdapterInterface;

class Action
{
    public function pagerfanta(AdapterInterface $adapter, int $page): Pagerfanta
    {
        $pagerfanta = new Pagerfanta($adapter);

        $pagerfanta->setMaxPerPage(3);
        $pagerfanta->setCurrentPage($page);

        return $pagerfanta;
    }
}
