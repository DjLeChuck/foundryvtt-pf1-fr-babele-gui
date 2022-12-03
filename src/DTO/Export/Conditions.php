<?php

namespace App\DTO\Export;

class Conditions
{
    public string $label = 'États préjudiciables';
    public iterable $entries;

    public function __construct(iterable $entries)
    {
        $this->entries = $entries;
    }
}
