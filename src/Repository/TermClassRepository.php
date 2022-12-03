<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\TermClass;
use Doctrine\Persistence\ManagerRegistry;

class TermClassRepository extends AbstractTermRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TermClass::class);
    }

    protected function getType(): string
    {
        return 'classes';
    }
}
