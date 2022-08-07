<?php

namespace App\DTO\Export;

class ClassAbilities
{
    public static string $packName = 'pf1.class-abilities.json';

    public string $label = 'Aptitudes de classe';
    public array $entries;

    public function __construct(array $entries)
    {
        $this->entries = $entries;
    }
}
