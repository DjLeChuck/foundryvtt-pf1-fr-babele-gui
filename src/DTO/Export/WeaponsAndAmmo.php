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
    public array $entries;

    public function __construct(array $entries)
    {
        $this->entries = $entries;
    }
}
