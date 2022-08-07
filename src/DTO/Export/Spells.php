<?php

namespace App\DTO\Export;

class Spells
{
    public static string $packName = 'pf1.spells.json';

    public string $label = 'Sorts';
    public array $mapping = [
        'identifiedName' => [
            'description' => 'data.shortDescription',
        ],
    ];
    public array $entries;

    public function __construct(array $entries)
    {
        $this->entries = $entries;
    }
}
