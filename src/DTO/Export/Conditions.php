<?php

namespace App\DTO\Export;

class Conditions
{
    public string $label = 'États préjudiciables';
    public array $entries;

    public function __construct(array $entries)
    {
        $this->entries = $entries;
    }
}
