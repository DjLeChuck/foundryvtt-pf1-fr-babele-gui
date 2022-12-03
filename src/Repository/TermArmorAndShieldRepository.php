<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\TermArmorAndShield;
use Doctrine\Persistence\ManagerRegistry;

class TermArmorAndShieldRepository extends AbstractTermRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TermArmorAndShield::class);
    }

    protected function getType(): string
    {
        return 'armors-and-shields';
    }
}
