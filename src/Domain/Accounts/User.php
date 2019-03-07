<?php

declare(strict_types=1);

namespace BeeJeeET\Domain\Accounts;

class User
{
    /**
     * @var UserId
     */
    protected $id;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $email;

    /**
     * @var string|null
     */
    protected $password;

    /**
     * @var boolean
     */
    protected $isAdmin;

    public function __construct(
        UserId $id,
        string $name,
        string $email,
        ?string $password = null,
        bool $isAdmin = false
    ) {
        $this->id = $id;
        $this->setName($name);
        $this->setEmail($email);
        $this->setPassword($password);
        $this->isAdmin = $isAdmin;
    }

    public function getId(): UserId
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    private function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    private function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function changePassword(string $password): void
    {
        $this->setPassword($password);
    }

    private function setPassword(?string $password): void
    {
        $this->password = $password;
    }

    public function isAdmin(): bool
    {
        return $this->isAdmin;
    }
}
