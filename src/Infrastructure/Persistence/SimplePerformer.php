<?php

declare(strict_types=1);

namespace BeeJeeET\Infrastructure\Persistence;

use BeeJeeET\Domain\Tasks\Performer;
use BeeJeeET\Domain\Accounts\User;

class SimplePerformer implements Performer
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $email;

    public static function fromUser(User $user): self
    {
        return new static(
            (string)$user->getId(),
            $user->getName(),
            $user->getEmail()
        );
    }

    public function __construct(string $id, string $name, string $email)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }
}
