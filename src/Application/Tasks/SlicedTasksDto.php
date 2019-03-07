<?php

declare(strict_types=1);

namespace BeeJeeET\Application\Tasks;

class SlicedTasksDto
{
    /**
     * @var int
     */
    public $total;

    /**
     * @var array
     */
    public $tasks;

    public function __construct(int $total, array $tasks)
    {
        $this->total = $total;
        $this->tasks = $tasks;
    }
}
