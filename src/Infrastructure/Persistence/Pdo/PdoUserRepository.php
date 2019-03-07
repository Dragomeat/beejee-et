<?php

declare(strict_types=1);

namespace BeeJeeET\Infrastructure\Persistence\Pdo;

use PDO;
use Ramsey\Uuid\UuidFactory;
use BeeJeeET\Infrastructure\Persistence\UserProxy;
use BeeJeeET\Domain\Accounts\User;
use BeeJeeET\Domain\Accounts\UserId;
use BeeJeeET\Domain\Accounts\UserNotFound;
use BeeJeeET\Domain\Accounts\UserRepository;
use BeeJeeET\Infrastructure\Persistence\UserMapper;

class PdoUserRepository implements UserRepository
{
    /**
     * @var PDO
     */
    private $pdo;

    /**
     * @var UuidFactory
     */
    private $uuid;

    /**
     * @var UserMapper
     */
    private $mapper;

    public function __construct(PDO $pdo, UuidFactory $uuid, UserMapper $mapper)
    {
        $this->pdo = $pdo;
        $this->uuid = $uuid;
        $this->mapper = $mapper;
    }

    /**
     * @throws \Exception
     * @return UserId
     */
    public function getNextIdentity(): UserId
    {
        return new UserId(
            (string)$this->uuid->uuid4()
        );
    }

    /**
     * @return User[]
     */
    public function all(): array
    {
        $tasks = $this->pdo
            ->query('SELECT * FROM `users`')
            ->fetchAll();

        return array_map(
            function (array $task): User {
                return $this->mapper->toEntity($task);
            },
            $tasks
        );
    }

    /**
     * @param  string $email
     * @throws UserNotFound
     * @return User
     */
    public function getByEmail(string $email): User
    {
        $query = $this->pdo
            ->prepare('SELECT * FROM users WHERE `email` = ? LIMIT 1');

        $query->execute([$email]);

        $user = $query->fetch();

        if (!$user) {
            throw UserNotFound::byEmail($email);
        }

        return $this->mapper->toEntity($user);
    }

    /**
     * @param  UserId $id
     * @throws UserNotFound
     * @return User
     */
    public function get(UserId $id): User
    {
        $query = $this->pdo
            ->prepare('SELECT * FROM `users` WHERE `id` = ? LIMIT 1');

        $query->execute([(string)$id]);

        $task = $query->fetch();

        if ($task === null) {
            throw UserNotFound::byId($id);
        }

        return $this->mapper->toEntity($task);
    }

    public function save(User $user): void
    {
        $attributes = $this->mapper->toArray($user);

        if ($user instanceof UserProxy && $user->isCreated()) {
            $stmt = $this->pdo->prepare(<<<'SQL'
                UPDATE `users` 
                SET `name` = :name, `password` = :password
                WHERE `id` = :id
            SQL
            );

            unset($attributes['email'], $attributes['is_admin']);

            $stmt->execute($attributes);
        } else {
            $stmt = $this->pdo->prepare(
                <<<'SQL'
                    INSERT INTO
                      `users`  (id, name, email, password, is_admin)
                    VALUES (:id, :name, :email, :password, :is_admin)
                SQL
            );

            $stmt->execute($attributes);
        }
    }
}
