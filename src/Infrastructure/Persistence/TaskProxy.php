<?php

declare(strict_types=1);

namespace BeeJeeET\Infrastructure\Persistence;

use BeeJeeET\Domain\Tasks\Task;

class TaskProxy extends Task
{
    /**
     * @return bool
     */
    public function isCreated(): bool
    {
        return true;
    }
}
