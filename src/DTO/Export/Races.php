<?php

namespace App\DTO\Export;

class Races
{
    public string $label = 'Races';
    public array $mapping = [
        'contextNotes'    => [
            'path'      => 'system.contextNotes',
            'converter' => 'contextNotes',
        ],
        'subTypes'        => [
            'path'      => 'system.subTypes',
            'converter' => 'arrayOfArray',
        ],
        'customLanguages' => [
            'path'      => 'system.languages.custom',
            'converter' => 'semicolonList',
        ],
    ];
    public iterable $entries;

    public function __construct(iterable $entries)
    {
        $this->entries = $entries;
    }
}
