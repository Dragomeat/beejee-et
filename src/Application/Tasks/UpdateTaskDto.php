<?php

declare(strict_types=1);

namespace BeeJeeET\Application\Tasks;

class UpdateTaskDto
{
    /**
     * @var string
     */
    public $id;

    /**
     * @var string
     */
    public $goal;

    public function __construct(string $id, string $goal)
    {
        $this->id = $id;
        $this->goal = $goal;
    }
}
