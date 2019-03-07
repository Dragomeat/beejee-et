<?php

declare(strict_types=1);

namespace BeeJeeET\Application\Accounts;

class SignInUserDto
{
    /**
     * @var string
     */
    public $email;

    /**
     * @var string
     */
    public $password;

    public function __construct(string $email, string $password)
    {
        $this->email = $email;
        $this->password = $password;
    }
}
