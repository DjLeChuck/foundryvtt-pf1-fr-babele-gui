<?php

namespace App\DTO\Export;

class CommonBuffs
{
    public string $label = 'Buffs communs';
    public array $mapping = [
        'contextNotes'    => [
            'path'      => 'system.contextNotes',
            'converter' => 'contextNotes',
        ],
        'flagsDictionary' => [
            'path'      => 'system.flags.dictionary',
            'converter' => 'flagsDictionary',
        ],
        'identifiedName'  => [
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
