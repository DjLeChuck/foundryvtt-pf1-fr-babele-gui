<?php

namespace App\DTO\Export;

class Conditions
{
    public static string $packName = 'pf1.conditions.json';

    public string $label = 'États préjudiciables';
    public array $entries;

    public function __construct(array $entries)
    {
        $this->entries = $entries;
    }
}
