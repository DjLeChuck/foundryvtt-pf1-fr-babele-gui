<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

trait UltimateEquipmentTrait
{
    #[ORM\Column(type: Types::JSON, nullable: true)]
    private ?array $results = null;

    public function getResults(): ?array
    {
        return $this->results;
    }

    public function setResults(?array $results): void
    {
        $this->results = $results;
    }
}
