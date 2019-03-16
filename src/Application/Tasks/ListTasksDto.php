<?php

declare(strict_types=1);

namespace BeeJeeET\Application\Tasks;

class ListTasksDto
{
    /**
     * @var int
     */
    public $page;

    /**
     * @var string
     */
    public $performer;

    /**
     * @var string
     */
    public $status;

    /**
     * @var int
     */
    public $perPage;

    public function __construct(
        int $page,
        string $performer,
        string $status,
        int $perPage = 3
    ) {
        $this->page = $page;
        $this->performer = $performer;
        $this->status = $status;
        $this->perPage = $perPage;
    }
}
