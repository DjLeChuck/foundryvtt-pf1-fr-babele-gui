<?php

namespace App\DTO\Export;

class UltimateEquipment
{
    public string $label = 'Équipement ultime';
    public iterable $entries;

    public function __construct(iterable $entries)
    {
        $this->entries = $entries;
    }
}
