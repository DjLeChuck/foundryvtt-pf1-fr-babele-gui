<?php

namespace App\DTO\Export;

class MonsterTemplates
{
    public string $label = 'Archétypes de monstres';
    public array $entries;

    public function __construct(array $entries)
    {
        $this->entries = $entries;
    }
}
