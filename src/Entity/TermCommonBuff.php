<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\TermCommonBuffRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TermCommonBuffRepository::class)]
#[ORM\Table(name: 'app_term_common_buff')]
class TermCommonBuff extends Term
{
    use CommonBuffTrait;
}
