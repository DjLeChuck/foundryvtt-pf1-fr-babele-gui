<?php

namespace App\DTO\Export;

class SampleMacros
{
    public string $label = 'Exemples de macros';
    public iterable $entries;

    public function __construct(iterable $entries)
    {
        $this->entries = $entries;
    }
}
