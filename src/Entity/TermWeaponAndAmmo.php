<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\TermWeaponAndAmmoRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TermWeaponAndAmmoRepository::class)]
#[ORM\Table(name: 'app_term_weapon_and_ammo')]
class TermWeaponAndAmmo extends Term
{
    use WeaponAndAmmoTrait;
}
