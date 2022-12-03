<?php

namespace App\DTO\Export;

class ClassAbilities
{
    public string $label = 'Aptitudes de classe';
    public iterable $entries;

    public function __construct(iterable $entries)
    {
        $this->entries = $entries;
    }
}
