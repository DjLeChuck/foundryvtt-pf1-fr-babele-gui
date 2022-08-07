<?php

namespace App\DTO\Export;

class MythicPaths
{
    public static string $packName = 'pf1.mythicpaths.json';

    public string $label = 'Voies mythiques';
    public array $entries;

    public function __construct(array $entries)
    {
        $this->entries = $entries;
    }
}
