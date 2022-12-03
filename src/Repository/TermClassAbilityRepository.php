<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\TermClassAbility;
use Doctrine\Persistence\ManagerRegistry;

class TermClassAbilityRepository extends AbstractTermRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TermClassAbility::class);
    }

    protected function getType(): string
    {
        return 'class-abilities';
    }
}
