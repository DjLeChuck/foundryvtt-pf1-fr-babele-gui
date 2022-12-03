<?php

namespace App\DTO\Export;

class RacialHD
{
    public string $label = 'Dés de vie raciaux';
    public iterable $entries;

    public function __construct(iterable $entries)
    {
        $this->entries = $entries;
    }
}
