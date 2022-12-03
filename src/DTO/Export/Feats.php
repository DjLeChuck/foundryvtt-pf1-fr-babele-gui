<?php

namespace App\DTO\Export;

class Feats
{
    public string $label = 'Dons';
    public array $mapping = [
        'actions'          => [
            'path'      => 'system.actions',
            'converter' => 'actions',
        ],
        'contextNotes'     => [
            'path'      => 'system.contextNotes',
            'converter' => 'contextNotes',
        ],
        'customWeaponProf' => [
            'path'      => 'system.weaponProf.custom',
            'converter' => 'semicolonList',
        ],
        'tags'             => [
            'path'      => 'system.tags',
            'converter' => 'arrayOfArray',
        ],
    ];
    public array $entries;

    public function __construct(array $entries)
    {
        $this->entries = $entries;
    }
}
