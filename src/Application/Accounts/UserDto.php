<?php

declare(strict_types=1);

namespace BeeJeeET\Application\Accounts;

class UserDto
{
    /**
     * @var string
     */
    public $id;

    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $email;

    /**
     * @var bool
     */
    public $isAdmin;

    public function __construct(string $id, string $name, string $email, bool $isAdmin)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->isAdmin = $isAdmin;
    }
}
