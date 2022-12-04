<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

trait RaceTrait
{
    #[ORM\Column(type: Types::JSON, nullable: true)]
    private ?array $customLanguages = null;

    #[ORM\Column(type: Types::JSON, nullable: true)]
    private ?array $subTypes = null;

    #[ORM\Column(type: Types::JSON, nullable: true)]
    private ?array $contextNotes = null;

    public function getCustomLanguages(): ?array
    {
        return $this->customLanguages;
    }

    public function setCustomLanguages(?array $customLanguages): void
    {
        $this->customLanguages = $customLanguages;
    }

    public function getSubTypes(): ?array
    {
        return $this->subTypes;
    }

    public function setSubTypes(?array $subTypes): void
    {
        $this->subTypes = $subTypes;
    }

    public function getContextNotes(): ?array
    {
        return $this->contextNotes;
    }

    public function setContextNotes(?array $contextNotes): void
    {
        $this->contextNotes = $contextNotes;
    }
}
