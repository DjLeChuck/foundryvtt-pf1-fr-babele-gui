<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

trait BestiaryTrait
{
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $img = null;

    public function getImg(): ?string
    {
        return $this->img;
    }

    public function setImg(?string $img): void
    {
        $this->img = $img;
    }
}
