<?php

namespace App\DTO\Export;

class Items
{
    public static string $packName = 'pf1.items.json';

    public string $label = 'Équipement';
    public array $entries;

    public function __construct(array $entries)
    {
        $this->entries = $entries;
    }
}
