<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

trait FeatTrait
{
    #[ORM\Column(type: Types::JSON, nullable: true)]
    private ?array $actions = null;

    #[ORM\Column(type: Types::JSON, nullable: true)]
    private ?array $contextNotes = null;

    #[ORM\Column(type: Types::JSON, nullable: true)]
    private ?array $customWeaponProf = null;

    #[ORM\Column(type: Types::JSON, nullable: true)]
    private ?array $tags = null;

    public function getActions(): ?array
    {
        return $this->actions;
    }

    public function setActions(?array $actions): void
    {
        $this->actions = $actions;
    }

    public function getContextNotes(): ?array
    {
        return $this->contextNotes;
    }

    public function setContextNotes(?array $contextNotes): void
    {
        $this->contextNotes = $contextNotes;
    }

    public function getCustomWeaponProf(): ?array
    {
        return $this->customWeaponProf;
    }

    public function setCustomWeaponProf(?array $customWeaponProf): void
    {
        $this->customWeaponProf = $customWeaponProf;
    }

    public function getTags(): ?array
    {
        return $this->tags;
    }

    public function setTags(?array $tags): void
    {
        $this->tags = $tags;
    }
}
