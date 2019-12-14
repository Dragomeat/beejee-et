<?php

declare(strict_types=1);

namespace BeeJeeET\Infrastructure\Persistence\Pdo;

use BeeJeeET\Domain\Slice;
use PDO;
use BeeJeeET\Domain\Tasks\Task;
use BeeJeeET\Domain\Tasks\TaskId;
use BeeJeeET\Domain\Tasks\TaskNotFound;
use BeeJeeET\Domain\Tasks\TaskRepository;
use BeeJeeET\Infrastructure\Persistence\TaskProxy;
use BeeJeeET\Infrastructure\Persistence\TaskMapper;
use BeeJeeET\Domain\Specifications\SpecificationInterface;
use BeeJeeET\Infrastructure\Persistence\Pdo\Specifications\PdoSpecification;
use Ramsey\Uuid\UuidFactory;

class PdoTaskRepository implements TaskRepository
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
     * @var TaskMapper
     */
    private $mapper;

    public function __construct(PDO $pdo, UuidFactory $uuid, TaskMapper $mapper)
    {
        $this->pdo = $pdo;
        $this->uuid = $uuid;
        $this->mapper = $mapper;
    }

    /**
     * @throws \Exception
     * @return TaskId
     */
    public function getNextIdentity(): TaskId
    {
        return new TaskId(
            (string)$this->uuid->uuid4()
        );
    }

    /**
     * @param Slice $slice
     * @return Task[]
     */
    public function all(Slice $slice): array
    {
        $stmt = $this->pdo
            ->prepare(<<<'SQL'
                SELECT 
                       performers.*,
                       `tasks`.*
                FROM `tasks`
                INNER JOIN users performers ON tasks.performer_id = performers.id
                LIMIT :limit OFFSET :offset 
                SQL
            );

        $stmt->bindValue(':limit', (int)$slice->length, PDO::PARAM_INT);
        $stmt->bindValue(':offset', (int)$slice->offset, PDO::PARAM_INT);

        $stmt->execute();

        $tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return array_map(
            function (array $task): Task {
                return $this->mapper->toEntity($task);
            },
            $tasks
        );
    }

    /**
     * @param Slice $slice
     * @param SpecificationInterface $specification
     * @return Task[]
     */
    public function matching(
        Slice $slice,
        SpecificationInterface $specification
    ): array {
        $where = $specification instanceof PdoSpecification
            ? 'WHERE ' . $specification->toSqlClauses()
            : '';

        $query = sprintf(
            <<<'SQL'
                SELECT 
                       performers.*,
                       `tasks`.*
                FROM `tasks` 
                INNER JOIN users performers ON tasks.performer_id = performers.id
                %s
                LIMIT :limit OFFSET :offset 
                SQL,
            $where
        );

        $stmt = $this->pdo->prepare($query);

        $stmt->bindValue(':limit', (int)$slice->length, PDO::PARAM_INT);
        $stmt->bindValue(':offset', (int)$slice->offset, PDO::PARAM_INT);

        $stmt->execute();

        $tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return array_map(
            function (array $task): Task {
                return $this->mapper->toEntity($task);
            },
            $tasks
        );
    }

    public function count(?SpecificationInterface $specification = null): int
    {
        $where = $specification instanceof PdoSpecification
            ? 'WHERE ' . $specification->toSqlClauses()
            : '';

        $query = sprintf(
            <<<'SQL'
                SELECT 
                   count(`id`)
                FROM `tasks`
                %s
                SQL,
            $where
        );

        return (int)$this->pdo->query($query)->fetchColumn();
    }

    /**
     * @param  TaskId $id
     * @throws TaskNotFound
     * @return Task
     */
    public function get(TaskId $id): Task
    {
        $query = $this->pdo
            ->prepare(
                <<<'SQL'
                SELECT 
                       `performers`.*,
                       `tasks`.*
                FROM `tasks` 
                INNER JOIN users performers ON tasks.performer_id = performers.id
                WHERE `tasks`.`id` = :id
                LIMIT 1
                SQL
            );

        $query->bindParam(':id', $id);

        $query->execute();

        $task = $query->fetch();

        if ($task === null) {
            throw TaskNotFound::byId($id);
        }

        return $this->mapper->toEntity($task);
    }

    /**
     * @param Task $task
     */
    public function save(Task $task): void
    {
        $attributes = $this->mapper->toArray($task);

        unset($attributes['performer']);

        if ($task instanceof TaskProxy && $task->isCreated()) {
            $stmt = $this->pdo->prepare(<<<'SQL'
                UPDATE `tasks` 
                SET 
                    `goal` = :goal,
                    `is_completed` = :is_completed,
                    `updated_at` = :updated_at
                WHERE `id` = :id
            SQL
            );

            unset($attributes['performer_id'], $attributes['created_at']);

            $stmt->execute($attributes);
        } else {
            $stmt = $this->pdo->prepare(
                <<<'SQL'
                    INSERT INTO
                      `tasks` (`id`, `performer_id`, `goal`, `is_completed`, `updated_at`, `created_at`) 
                    VALUES (:id, :performer_id, :goal, :is_completed, :updated_at, :created_at)
                SQL
            );

            $stmt->execute($attributes);
        }
    }
}
