<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\TermSpell;
use Doctrine\Persistence\ManagerRegistry;

class TermSpellRepository extends AbstractTermRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TermSpell::class);
    }

    protected function getType(): string
    {
        return 'spells';
    }
}
