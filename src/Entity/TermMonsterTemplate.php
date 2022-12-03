<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\TermMonsterTemplateRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TermMonsterTemplateRepository::class)]
#[ORM\Table(name: 'app_term_monster_template')]
class TermMonsterTemplate extends Term
{
    use MonsterTemplateTrait;
}
