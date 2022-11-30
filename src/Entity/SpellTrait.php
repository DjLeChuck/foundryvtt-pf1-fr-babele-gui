<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

trait SpellTrait
{
    #[ORM\Column(type: Types::JSON, nullable: true)]
    private ?array $actions = null;

    #[ORM\Column(type: Types::JSON, nullable: true)]
    private ?array $learnedAtClasses = null;

    #[ORM\Column(type: Types::JSON, nullable: true)]
    private ?array $learnedAtDomains = null;

    #[ORM\Column(type: Types::JSON, nullable: true)]
    private ?array $learnedAtSubDomains = null;

    #[ORM\Column(type: Types::JSON, nullable: true)]
    private ?array $learnedAtBloodlines = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $materials = null;

    public function getActions(): ?array
    {
        return $this->actions;
    }

    public function setActions(?array $actions): void
    {
        $this->actions = $actions;
    }

    public function getLearnedAtClasses(): ?array
    {
        return $this->learnedAtClasses;
    }

    public function setLearnedAtClasses(?array $learnedAtClasses): void
    {
        $this->learnedAtClasses = $learnedAtClasses;
    }

    public function getLearnedAtDomains(): ?array
    {
        return $this->learnedAtDomains;
    }

    public function setLearnedAtDomains(?array $learnedAtDomains): void
    {
        $this->learnedAtDomains = $learnedAtDomains;
    }

    public function getLearnedAtSubDomains(): ?array
    {
        return $this->learnedAtSubDomains;
    }

    public function setLearnedAtSubDomains(?array $learnedAtSubDomains): void
    {
        $this->learnedAtSubDomains = $learnedAtSubDomains;
    }

    public function getLearnedAtBloodlines(): ?array
    {
        return $this->learnedAtBloodlines;
    }

    public function setLearnedAtBloodlines(?array $learnedAtBloodlines): void
    {
        $this->learnedAtBloodlines = $learnedAtBloodlines;
    }

    public function getMaterials(): ?string
    {
        return $this->materials;
    }

    public function setMaterials(?string $materials): void
    {
        $this->materials = $materials;
    }
}
