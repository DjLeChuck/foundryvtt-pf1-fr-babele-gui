<?php

namespace App\DTO\Export;

class Items
{
    public string $label = 'Équipement';
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
