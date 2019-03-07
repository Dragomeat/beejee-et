<?php

declare(strict_types=1);

namespace BeeJeeET\Application\Accounts;

class SignUpDto
{
    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $email;

    /**
     * @var string|null
     */
    public $password;

    public function __construct(string $name, string $email, ?string $password = null)
    {
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
    }
}
