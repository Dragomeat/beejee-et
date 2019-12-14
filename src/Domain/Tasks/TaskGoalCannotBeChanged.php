<?php

declare(strict_types=1);

namespace BeeJeeET\Domain\Tasks;

use Throwable;
use DomainException;

class TaskGoalCannotBeChanged extends DomainException
{
    public static function taskAlreadyCompleted(TaskId $id): self
    {
        return new static(
            sprintf(
                'The goal of the task cannot be changed, because Task#%s has already been completed.',
                $id->getValue()
            )
        );
    }

    public function __construct(
        string $message = 'The goal of the task cannot be changed.',
        Throwable $previous = null
    ) {
        parent::__construct($message, 0, $previous);
    }
}
