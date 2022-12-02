<?php

namespace App\DTO\Export;

class Races
{
    public string $label = 'Races';
    public array $mapping = [
        'contextNotes' => [
            'path'      => 'system.contextNotes',
            'converter' => 'contextNotes',
        ],
        'subTypes'     => [
            'path'      => 'system.subTypes',
            'converter' => 'arrayOfArray',
        ],
    ];
    public array $entries;

    public function __construct(array $entries)
    {
        $this->entries = $entries;
    }
}
