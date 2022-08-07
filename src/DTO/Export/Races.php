<?php

namespace App\DTO\Export;

class Races
{
    public static string $packName = 'pf1.races.json';

    public string $label = 'Races';
    public array $entries;

    public function __construct(array $entries)
    {
        $this->entries = $entries;
    }
}
