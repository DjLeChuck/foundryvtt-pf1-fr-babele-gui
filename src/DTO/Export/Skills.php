<?php

namespace App\DTO\Export;

class Skills
{
    public static string $packName = 'pf1.skills.json';

    public string $label = 'Compétences';
    public array $entries;

    public function __construct(array $entries)
    {
        $this->entries = $entries;
    }
}
