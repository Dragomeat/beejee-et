<?php

declare(strict_types=1);

namespace BeeJeeET\Domain\Tasks;

use DomainException;
use Throwable;

class TaskNotFound extends DomainException
{
    public static function byId(TaskId $id, Throwable $previous = null): self
    {
        $message = sprintf('The task [%s] was not found.', $id->getValue());

        return new static($message, $previous);
    }

    public function __construct(
        string $message = 'The task with the passed identifier was not found.',
        Throwable $previous = null
    ) {
        parent::__construct($message, 0, $previous);
    }
}
