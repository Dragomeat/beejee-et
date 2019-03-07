<?php

declare(strict_types=1);

namespace BeeJeeET\Domain\Accounts;

use Throwable;
use DomainException;

class InvalidCredentials extends DomainException
{
    public function __construct(string $message = 'Invalid credentials.', Throwable $previous = null)
    {
        parent::__construct($message, 0, $previous);
    }
}
