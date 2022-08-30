<?php

namespace App\DTO\Export;

class Bestiary
{
    public string $label = '__OVERRIDE__';
    public array $entries;

    public function __construct(array $entries)
    {
        $this->entries = $entries;
    }
}
