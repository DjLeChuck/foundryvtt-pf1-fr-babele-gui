<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\TermRace;
use Doctrine\Persistence\ManagerRegistry;

class TermRaceRepository extends AbstractTermRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TermRace::class);
    }

    protected function getType(): string
    {
        return 'races';
    }
}
