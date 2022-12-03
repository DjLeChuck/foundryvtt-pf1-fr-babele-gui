<?php

namespace App\DTO\Export;

class UltimateEquipment
{
    public string $label = 'Équipement ultime';
    public array $mapping = [
        'results' => [
            'path'      => 'results',
            'converter' => 'tableRollText',
        ],
    ];
    public iterable $entries;

    public function __construct(iterable $entries)
    {
        $this->entries = $entries;
    }
}
