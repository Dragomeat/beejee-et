<?php

declare(strict_types=1);

namespace BeeJeeET\Domain\Accounts;

use Throwable;
use DomainException;

class AlreadyAuthenticated extends DomainException
{
    public function __construct(string $message = 'Already authenticated.', Throwable $previous = null)
    {
        parent::__construct($message, 0, $previous);
    }
}
