<?php

namespace App\DTO\Export;

class ArmorsAndShields
{
    public string $label = 'Armures et boucliers';
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
