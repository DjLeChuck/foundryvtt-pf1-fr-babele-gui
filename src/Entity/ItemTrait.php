<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

trait ItemTrait
{
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $unidentifiedName = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $unidentifiedDescription = null;

    public function getUnidentifiedName(): ?string
    {
        return $this->unidentifiedName;
    }

    public function setUnidentifiedName(?string $unidentifiedName): void
    {
        $this->unidentifiedName = $unidentifiedName;
    }

    public function getUnidentifiedDescription(): ?string
    {
        return $this->unidentifiedDescription;
    }

    public function setUnidentifiedDescription(?string $unidentifiedDescription): void
    {
        $this->unidentifiedDescription = $unidentifiedDescription;
    }
}