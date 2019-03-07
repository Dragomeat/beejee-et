<?php

declare(strict_types=1);

namespace BeeJeeET\Domain;

class Slice
{
    /**
     * @var int
     */
    public $offset;

    /**
     * @var int
     */
    public $length;

    public function __construct(int $offset, int $length)
    {
        $this->offset = $offset;
        $this->length = $length;
    }
}
