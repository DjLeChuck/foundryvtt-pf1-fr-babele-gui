<?php

namespace App\DTO\Export;

class SampleMacros
{
    public string $label = 'Exemples de macros';
    public array $entries;

    public function __construct(array $entries)
    {
        $this->entries = $entries;
    }
}
