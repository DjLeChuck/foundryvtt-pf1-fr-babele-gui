<?php

namespace App\DTO\Export;

class RollTables
{
    public string $label = 'Tables aléatoires';
    public iterable $entries;

    public function __construct(iterable $entries)
    {
        $this->entries = $entries;
    }
}
