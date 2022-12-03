<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\TermRollTable;
use Doctrine\Persistence\ManagerRegistry;

class TermRollTableRepository extends AbstractTermRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TermRollTable::class);
    }

    protected function getType(): string
    {
        return 'roll-tables';
    }
}
