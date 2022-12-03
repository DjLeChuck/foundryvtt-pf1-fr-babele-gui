<?php

namespace App\DTO\Export;

class MonsterTemplates
{
    public string $label = 'Archétypes de monstres';
    public iterable $entries;

    public function __construct(iterable $entries)
    {
        $this->entries = $entries;
    }
}
