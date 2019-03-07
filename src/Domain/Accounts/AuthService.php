<?php

declare(strict_types=1);

namespace BeeJeeET\Domain\Accounts;

abstract class AuthService
{
    /**
     * @var UserRepository
     */
    private $users;

    public function __construct(UserRepository $users)
    {
        $this->users = $users;
    }

    /**
     * @param string $email
     * @param string $password
     * @throws AlreadyAuthenticated
     * @throws UserNotFound
     * @throws InvalidCredentials
     * @return void
     */
    public function authenticate(string $email, string $password): void
    {
        if ($this->isAuthenticated()) {
            throw new AlreadyAuthenticated();
        }

        $user = $this->users->getByEmail($email);

        $hash = $user->getPassword();

        if ($hash !== null
            && !password_verify($password, $hash)) {
            throw new InvalidCredentials();
        }

        $this->persist($user);
    }

    public function isAuthenticated(): bool
    {
        return $this->getUser() !== null;
    }

    abstract public function persist(User $user): void;

    abstract public function getUser(): ?User;

    abstract public function logout(): void;
}
