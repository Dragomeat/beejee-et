<?php

declare(strict_types=1);

namespace BeeJeeET\Domain\Tasks;

class Task
{
    /**
     * @var TaskId
     */
    protected $id;

    /**
     * @var Performer
     */
    protected $performer;

    /**
     * @var string
     */
    protected $goal;

    /**
     * @var bool
     */
    protected $isCompleted = false;

    public function __construct(TaskId $id, Performer $performer, string $goal)
    {
        $this->id = $id;
        $this->performer = $performer;
        $this->setGoal($goal);
    }

    public function getId(): TaskId
    {
        return $this->id;
    }

    public function getPerformer(): Performer
    {
        return $this->performer;
    }

    public function getGoal(): string
    {
        return $this->goal;
    }

    public function changeGoal(string $goal): void
    {
        $this->setGoal($goal);
    }

    private function setGoal(string $goal): void
    {
        $this->goal = $goal;
    }

    /**
     * @return bool
     */
    public function isCompleted(): bool
    {
        return $this->isCompleted;
    }

    public function complete(): Task
    {
        $this->isCompleted = true;

        return $this;
    }

    public function activate(): Task
    {
        $this->isCompleted = false;

        return $this;
    }
}
