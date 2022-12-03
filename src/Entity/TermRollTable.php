<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\TermRollTableRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TermRollTableRepository::class)]
#[ORM\Table(name: 'app_term_roll_table')]
class TermRollTable extends Term
{
    use RollTableTrait;
}
