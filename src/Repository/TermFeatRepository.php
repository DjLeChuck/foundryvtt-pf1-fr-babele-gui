<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\TermFeat;
use Doctrine\Persistence\ManagerRegistry;

class TermFeatRepository extends AbstractTermRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TermFeat::class);
    }

    protected function getType(): string
    {
        return 'feats';
    }
}
