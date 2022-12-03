<?php

namespace App\DTO\Export;

class Classes
{
    public string $label = 'Classes';
    public array $mapping = [
        'customWeaponProf'     => [
            'path'      => 'system.weaponProf.custom',
            'converter' => 'semicolonList',
        ],
    ];
    public iterable $entries;

    public function __construct(iterable $entries)
    {
        $this->entries = $entries;
    }
}
