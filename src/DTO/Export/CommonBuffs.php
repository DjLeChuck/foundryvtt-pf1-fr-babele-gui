<?php

namespace App\DTO\Export;

class CommonBuffs
{
    public string $label = 'Buffs communs';
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
