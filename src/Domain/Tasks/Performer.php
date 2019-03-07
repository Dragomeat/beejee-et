<?php

declare(strict_types=1);

namespace BeeJeeET\Domain\Tasks;

interface Performer
{
    public function getId(): string;

    public function getName(): string;

    public function getEmail(): string;
}
