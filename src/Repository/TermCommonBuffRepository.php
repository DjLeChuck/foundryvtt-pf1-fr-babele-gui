<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\TermCommonBuff;
use Doctrine\Persistence\ManagerRegistry;

class TermCommonBuffRepository extends AbstractTermRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TermCommonBuff::class);
    }

    protected function getType(): string
    {
        return 'commonbuffs';
    }
}
