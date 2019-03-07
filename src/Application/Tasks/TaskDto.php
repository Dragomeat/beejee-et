<?php

declare(strict_types=1);

namespace BeeJeeET\Application\Tasks;

class TaskDto
{
    /**
     * @var string
     */
    public $id;

    /**
     * @var PerformerDto
     */
    public $performer;

    /**
     * @var string
     */
    public $goal;

    /**
     * @var bool
     */
    public $isCompleted;

    public function __construct(string $id, PerformerDto $performer, string $goal, bool $isCompleted)
    {
        $this->id = $id;
        $this->performer = $performer;
        $this->goal = $goal;
        $this->isCompleted = $isCompleted;
    }
}
