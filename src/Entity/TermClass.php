<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\TermClassRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TermClassRepository::class)]
#[ORM\Table(name: 'app_term_class')]
class TermClass extends Term
{
    use ClassTrait;
}
