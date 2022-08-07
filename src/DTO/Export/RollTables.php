<?php

namespace App\DTO\Export;

class RollTables
{
    public string $label = 'Tables aléatoires';
    public array $entries;

    public function __construct(array $entries)
    {
        $this->entries = $entries;
    }
}
