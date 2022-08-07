<?php

namespace App\DTO\Export;

class Classes
{
    public static string $packName = 'pf1.classes.json';

    public string $label = 'Classes';
    public array $entries;

    public function __construct(array $entries)
    {
        $this->entries = $entries;
    }
}
