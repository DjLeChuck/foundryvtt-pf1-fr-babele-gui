<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\TermRacialHdRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TermRacialHdRepository::class)]
#[ORM\Table(name: 'app_term_racial_hd')]
class TermRacialHd extends Term
{
    public function getCompendiumLinkTag(): string
    {
        return sprintf('@UUID[Compendium.pf1.racialhd.%s]{__label__}', $this->getPackId());
    }
}
