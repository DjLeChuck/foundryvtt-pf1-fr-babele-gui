<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\TermRacialHd;
use Doctrine\Persistence\ManagerRegistry;

class TermRacialHdRepository extends AbstractTermRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TermRacialHd::class);
    }

    protected function getType(): string
    {
        return 'racial-hd';
    }
}
