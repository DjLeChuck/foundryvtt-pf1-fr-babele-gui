<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\TermWeaponAndAmmo;
use Doctrine\Persistence\ManagerRegistry;

class TermWeaponAndAmmoRepository extends AbstractTermRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TermWeaponAndAmmo::class);
    }

    protected function getType(): string
    {
        return 'weapons-and-ammo';
    }
}
