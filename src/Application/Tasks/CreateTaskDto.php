<?php

declare(strict_types=1);

namespace BeeJeeET\Application\Tasks;

class CreateTaskDto
{
    /**
     * @var string
     */
    public $goal;

    public function __construct(string $goal)
    {
        $this->goal = $goal;
    }
}
