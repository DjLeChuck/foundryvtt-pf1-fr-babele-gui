<?php

namespace App\DTO\Export;

class ClassAbilities
{
    public string $label = 'Aptitudes de classe';
    public array $mapping = [
        'actions'            => [
            'path'      => 'system.actions',
            'converter' => 'actions',
        ],
        'contextNotes'    => [
            'path'      => 'system.contextNotes',
            'converter' => 'contextNotes',
        ],
        'tags'             => [
            'path'      => 'system.tags',
            'converter' => 'arrayOfArray',
        ],
        'classes'      => [
            'path'      => 'system.associations.classes',
            'converter' => 'arrayOfArray',
        ],
    ];
    public iterable $entries;

    public function __construct(iterable $entries)
    {
        $this->entries = $entries;
    }
}
