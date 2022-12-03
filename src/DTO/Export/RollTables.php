<?php

namespace App\DTO\Export;

class RollTables
{
    public string $label = 'Tables aléatoires';
    public array $mapping = [
        'results' => [
            'path'      => 'results',
            'converter' => 'tableRollText',
        ],
    ];
    public iterable $entries;

    public function __construct(iterable $entries)
    {
        $this->entries = $entries;
    }
}
