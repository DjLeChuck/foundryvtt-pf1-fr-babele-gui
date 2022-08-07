<?php

namespace App\DTO\Export;

class MonsterTemplates
{
    public static string $packName = 'pf1.monster-templatess.json';

    public string $label = 'Modèles de monstres';
    public array $entries;

    public function __construct(array $entries)
    {
        $this->entries = $entries;
    }
}
