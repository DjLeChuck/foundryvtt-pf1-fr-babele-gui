<?php

namespace App\DTO\Export;

class MonsterTemplates
{
    public string $label = 'Archétypes de monstres';
    public array $mapping = [
        'contextNotes'     => [
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
