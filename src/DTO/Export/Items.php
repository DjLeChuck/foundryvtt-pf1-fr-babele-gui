<?php

namespace App\DTO\Export;

class Items
{
    public string $label = 'Équipement';
    public array $mapping = [
        'identifiedName'          => [
            'path'      => 'system.identifiedName',
            'converter' => 'name',
        ],
        'unidentifiedDescription' => 'system.description.unidentified',
        'unidentifiedName'        => 'system.unidentified.name',
        'actions'                 => [
            'path'      => 'system.actions',
            'converter' => 'actions',
        ],
        'contextNotes'            => [
            'path'      => 'system.contextNotes',
            'converter' => 'contextNotes',
        ],
    ];
    public iterable $entries;

    public function __construct(iterable $entries)
    {
        $this->entries = $entries;
    }
}
