<?php

namespace App\DTO\Export;

class WeaponsAndAmmo
{
    public string $label = 'Armes et munitions';
    public array $mapping = [
        'identifiedName' => [
            'path'      => 'system.identifiedName',
            'converter' => 'name',
        ],
    ];
    public iterable $entries;

    public function __construct(iterable $entries)
    {
        $this->entries = $entries;
    }
}
