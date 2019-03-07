<?php

declare(strict_types=1);

namespace BeeJeeET\Domain\Accounts;

interface UserRepository
{
    public function getNextIdentity(): UserId;

    /**
     * @return User[]
     */
    public function all(): array;

    /**
     * @param  string $email
     * @throws UserNotFound
     * @return User
     */
    public function getByEmail(string $email): User;

    /**
     * @param  UserId $id
     * @throws UserNotFound
     * @return User
     */
    public function get(UserId $id): User;

    public function save(User $user): void;
}
