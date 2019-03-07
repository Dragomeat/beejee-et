<?php

declare(strict_types=1);

namespace BeeJeeET\Application\Tasks;

class ActivateTaskDto
{
    /**
     * @var string
     */
    public $id;

    public function __construct(string $id)
    {
        $this->id = $id;
    }
}
