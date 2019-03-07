<?php

declare(strict_types=1);

namespace BeeJeeET\Infrastructure\Accounts;

use BeeJeeET\Domain\Accounts\User;
use BeeJeeET\Domain\Accounts\AuthService;
use BeeJeeET\Domain\Accounts\UserId;
use BeeJeeET\Domain\Accounts\UserNotFound;
use BeeJeeET\Domain\Accounts\UserRepository;

class SessionAuthService extends AuthService
{
    /**
     * @var UserRepository
     */
    private $users;

    /**
     * @var ?User
     */
    private $user;

    public function __construct(UserRepository $users)
    {
        parent::__construct($users);

        $this->users = $users;
    }

    public function persist(User $user): void
    {
        $_SESSION['userId'] = (string)$user->getId();
    }

    public function getUser(): ?User
    {
        if ($this->user !== null) {
            return $this->user;
        }

        if (! array_key_exists('userId', $_SESSION)) {
            return null;
        }

        $id = new UserId(
            $_SESSION['userId']
        );

        try {
            return $this->users->get($id);
        } catch (UserNotFound $e) {
            return null;
        }
    }

    public function logout(): void
    {
        session_unset();
    }
}
