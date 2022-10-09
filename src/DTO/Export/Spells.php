<?php

namespace App\DTO\Export;

class Spells
{
    public string $label = 'Sorts';
    public array $mapping = [
        'description' => 'system.shortDescription',
    ];
    public array $entries;

    public function __construct(array $entries)
    {
        $this->entries = $entries;
    }
}
