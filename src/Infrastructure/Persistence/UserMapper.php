<?php

declare(strict_types=1);

namespace BeeJeeET\Infrastructure\Persistence;

use BeeJeeET\Domain\Accounts\User;
use BeeJeeET\Domain\Accounts\UserId;
use BeeJeeET\Infrastructure\ObjectHydrator;

class UserMapper
{
    /**
     * @var ObjectHydrator
     */
    private $hydrator;

    public function __construct(ObjectHydrator $hydrator)
    {
        $this->hydrator = $hydrator;
    }

    public function toArray(User $user): array
    {
        $values = $this->hydrator->extract($user);

        return [
            'id' => (string)$values['id'],
            'name' => $values['name'],
            'email' => $values['email'],
            'password' => $values['password'],
            'is_admin' => (int)$values['isAdmin'],
        ];
    }

    public function toEntity(array $values): User
    {
        $values = [
            'id' => new UserId($values['id']),
            'name' => $values['name'],
            'email' => $values['email'],
            'password' => $values['password'],
            'isAdmin' => (bool)$values['is_admin'],
        ];

        /**
         * @var User $user
         */
        $user = $this->hydrator->hydrate($values);

        return $user;
    }
}
