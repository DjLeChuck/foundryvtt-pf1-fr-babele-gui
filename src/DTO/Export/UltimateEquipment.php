<?php

namespace App\DTO\Export;

class UltimateEquipment
{
    public static string $packName = 'pf1.ultimate-equipment.json';

    public string $label = 'Équipement ultime';
    public array $entries;

    public function __construct(array $entries)
    {
        $this->entries = $entries;
    }
}
