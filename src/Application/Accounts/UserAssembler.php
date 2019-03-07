<?php

declare(strict_types=1);

namespace BeeJeeET\Application\Accounts;

use BeeJeeET\Domain\Accounts\User;
use BeeJeeET\Domain\Accounts\UserId;
use BeeJeeET\Infrastructure\ObjectHydrator;

class UserAssembler
{
    /**
     * @var ObjectHydrator
     */
    private $hydrator;

    public function __construct(ObjectHydrator $hydrator)
    {
        $this->hydrator = $hydrator;
    }

    public function toDto(User $user): UserDto
    {
        return new UserDto(
            (string)$user->getId(),
            $user->getName(),
            $user->getEmail(),
            $user->isAdmin()
        );
    }

    public function toEntity(UserDto $dto): User
    {
        /**
         * @var User $user
         */
        $user = $this->hydrator->hydrate(
            [
                'id' => new UserId($dto->id),
                'name' => $dto->name,
                'email' => $dto->email,
            ]
        );

        return $user;
    }
}
