<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\TermClassAbilityRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TermClassAbilityRepository::class)]
#[ORM\Table(name: 'app_term_class_ability')]
class TermClassAbility extends Term
{
    use ClassAbilityTrait;
}
