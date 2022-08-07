<?php

namespace App\DTO\Export;

class ArmorsAndShields
{
    public string $label = 'Armures et boucliers';
    public array $mapping = [
        'identifiedName' => [
            'path'      => 'data.identifiedName',
            'converter' => 'name',
        ],
    ];
    public array $entries;

    public function __construct(array $entries)
    {
        $this->entries = $entries;
    }
}
