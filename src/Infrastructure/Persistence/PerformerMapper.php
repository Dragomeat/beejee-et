<?php

declare(strict_types=1);

namespace BeeJeeET\Infrastructure\Persistence;

use BeeJeeET\Domain\Tasks\Performer;
use BeeJeeET\Infrastructure\ObjectHydrator;

class PerformerMapper
{
    /**
     * @var ObjectHydrator
     */
    private $hydrator;

    public function __construct(ObjectHydrator $hydrator)
    {
        $this->hydrator = $hydrator;
    }

    public function toArray(Performer $performer): array
    {
        return $this->hydrator->extract($performer);
    }

    public function toEntity(array $values): Performer
    {
        /**
         * @var Performer $performer
         */
        $performer = $this->hydrator->hydrate($values);

        return $performer;
    }
}
