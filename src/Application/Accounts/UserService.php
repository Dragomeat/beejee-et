<?php

declare(strict_types=1);

namespace BeeJeeET\Application\Accounts;

use BeeJeeET\Domain\Accounts\User;
use BeeJeeET\Domain\Accounts\AuthService;
use BeeJeeET\Domain\Accounts\UserRepository;

class UserService
{
    /**
     * @var UserRepository
     */
    private $users;

    /**
     * @var AuthService
     */
    private $auth;

    /**
     * @var UserAssembler
     */
    private $assembler;

    public function __construct(
        UserRepository $users,
        AuthService $auth,
        UserAssembler $assembler
    ) {
        $this->users = $users;
        $this->auth = $auth;
        $this->assembler = $assembler;
    }

    public function list(): array
    {
        $users = $this->users->all();

        return array_map(
            function (User $user): UserDto {
                return $this->assembler->toDto($user);
            },
            $users
        );
    }

    public function signIn(SignInUserDto $dto): UserDto
    {
        $this->auth->authenticate($dto->email, $dto->password);

        /**
         * @var User $user
         */
        $user = $this->auth->getUser();

        return $this->assembler->toDto($user);
    }

    public function signUp(SignUpDto $dto): UserDto
    {
        $password = $dto->password !== null
            ? password_hash($dto->password, PASSWORD_BCRYPT)
            : null;


        $user = new User(
            $this->users->getNextIdentity(),
            $dto->name,
            $dto->email,
            $password
        );

        $this->users->save($user);

        $this->auth->persist($user);

        return $this->assembler->toDto($user);
    }
}
