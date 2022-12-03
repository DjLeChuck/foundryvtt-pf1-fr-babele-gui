<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\TermMonsterTemplate;
use Doctrine\Persistence\ManagerRegistry;

class TermMonsterTemplateRepository extends AbstractTermRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TermMonsterTemplate::class);
    }

    protected function getType(): string
    {
        return 'monster-templates';
    }
}
