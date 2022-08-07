<?php

namespace App\DTO\Export;

class UltimateEquipment
{
    public string $label = 'Équipement ultime';
    public array $entries;

    public function __construct(array $entries)
    {
        $this->entries = $entries;
    }
}
