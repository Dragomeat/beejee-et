<?php

declare(strict_types=1);

namespace BeeJeeET\Application\Tasks;

use BeeJeeET\Domain\Tasks\Performer;
use BeeJeeET\Infrastructure\ObjectHydrator;

class PerformerAssembler
{
    /**
     * @var ObjectHydrator
     */
    private $hydrator;

    public function __construct(ObjectHydrator $hydrator)
    {
        $this->hydrator = $hydrator;
    }

    public function toDto(Performer $performer): PerformerDto
    {
        return new PerformerDto(
            $performer->getId(),
            $performer->getName(),
            $performer->getEmail()
        );
    }

    public function toEntity(PerformerDto $dto): Performer
    {
        /**
         * @var Performer $performer
         */
        $performer = $this->hydrator->hydrate(
            [
                'id' => $dto->id,
                'name' => $dto->name,
                'email' => $dto->email,
            ]
        );

        return $performer;
    }
}
