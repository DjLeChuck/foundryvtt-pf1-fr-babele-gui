<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\TermItemRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TermItemRepository::class)]
#[ORM\Table(name: 'app_term_item')]
class TermItem extends Term
{
    use ItemTrait;
}
