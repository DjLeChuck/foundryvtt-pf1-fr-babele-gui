<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\TermSpellRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TermSpellRepository::class)]
#[ORM\Table(name: 'app_term_spell')]
class TermSpell extends Term
{
    use SpellTrait;
}
