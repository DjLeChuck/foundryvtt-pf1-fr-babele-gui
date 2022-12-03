<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\TermFeatRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TermFeatRepository::class)]
#[ORM\Table(name: 'app_term_feat')]
class TermFeat extends Term
{
    use FeatTrait;
}
