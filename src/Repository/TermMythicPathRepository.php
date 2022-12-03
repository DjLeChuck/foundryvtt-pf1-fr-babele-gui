<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\TermMythicPath;
use Doctrine\Persistence\ManagerRegistry;

class TermMythicPathRepository extends AbstractTermRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TermMythicPath::class);
    }

    protected function getType(): string
    {
        return 'mythic-paths';
    }
}
