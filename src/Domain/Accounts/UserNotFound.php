<?php

declare(strict_types=1);

namespace BeeJeeET\Domain\Accounts;

use Throwable;
use DomainException;

class UserNotFound extends DomainException
{
    public static function byId(UserId $id, Throwable $previous = null): self
    {
        $message = sprintf('The user [%s] was not found.', $id->getValue());

        return new static($message, $previous);
    }

    public static function byEmail(string $email, Throwable $previous = null): self
    {
        $message = sprintf('The user [%s] was not found.', $email);

        return new static($message, $previous);
    }

    public function __construct(
        string $message = 'The user with the passed identifier was not found.',
        Throwable $previous = null
    ) {
        parent::__construct($message, 0, $previous);
    }
}
