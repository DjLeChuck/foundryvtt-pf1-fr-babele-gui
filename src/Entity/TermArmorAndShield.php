<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\TermArmorAndShieldRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TermArmorAndShieldRepository::class)]
#[ORM\Table(name: 'app_term_armor_and_shield')]
class TermArmorAndShield extends Term
{
}
