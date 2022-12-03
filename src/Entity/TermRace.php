<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\TermRaceRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TermRaceRepository::class)]
#[ORM\Table(name: 'app_term_race')]
class TermRace extends Term
{
    use RaceTrait;
}
