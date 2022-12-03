<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\TermUltimateEquipmentRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TermUltimateEquipmentRepository::class)]
#[ORM\Table(name: 'app_term_ultimate_equipment')]
class TermUltimateEquipment extends Term
{
    use UltimateEquipmentTrait;
}
