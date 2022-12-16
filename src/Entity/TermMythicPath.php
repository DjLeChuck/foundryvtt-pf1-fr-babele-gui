<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\TermMythicPathRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TermMythicPathRepository::class)]
#[ORM\Table(name: 'app_term_mythic_path')]
class TermMythicPath extends Term
{
    public function getCompendiumLinkTag(): string
    {
        return sprintf('@UUID[Compendium.pf1.mythicpaths.%s]{__label__}', $this->getPackId());
    }
}
