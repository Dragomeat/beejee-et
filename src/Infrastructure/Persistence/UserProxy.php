<?php

declare(strict_types=1);

namespace BeeJeeET\Infrastructure\Persistence;

use BeeJeeET\Domain\Accounts\User;

class UserProxy extends User
{
    /**
     * @return bool
     */
    public function isCreated(): bool
    {
        return true;
    }
}
