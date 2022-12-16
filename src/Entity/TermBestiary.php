<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\TermBestiaryRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TermBestiaryRepository::class)]
#[ORM\Table(name: 'app_term_bestiary')]
class TermBestiary extends Term
{
    use BestiaryTrait;

    public function getCompendiumLinkTag(): string
    {
        return sprintf('@UUID[Compendium.pf1-bestiary.%s.%s]{__label__}', $this->getPack(), $this->getPackId());
    }
}
