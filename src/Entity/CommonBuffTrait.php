<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

trait CommonBuffTrait
{
    #[ORM\Column(type: Types::JSON, nullable: true)]
    private ?array $dictionaryFlags = null;

    #[ORM\Column(type: Types::JSON, nullable: true)]
    private ?array $contextNotes = null;

    public function getDictionaryFlags(): ?array
    {
        return $this->dictionaryFlags;
    }

    public function setDictionaryFlags(?array $dictionaryFlags): void
    {
        $this->dictionaryFlags = $dictionaryFlags;
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
