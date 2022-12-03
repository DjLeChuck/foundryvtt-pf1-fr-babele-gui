<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\TermUltimateEquipment;
use Doctrine\Persistence\ManagerRegistry;

class TermUltimateEquipmentRepository extends AbstractTermRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TermUltimateEquipment::class);
    }

    protected function getType(): string
    {
        return 'ultimate-equipment';
    }
}
