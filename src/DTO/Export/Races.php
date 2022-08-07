<?php

namespace App\DTO\Export;

class Races
{
    public string $label = 'Races';
    public array $entries;

    public function __construct(array $entries)
    {
        $this->entries = $entries;
    }
}
