<?php

namespace App\DTO\Export;

class RacialHD
{
    public string $label = 'Dés de vie raciaux';
    public array $entries;

    public function __construct(array $entries)
    {
        $this->entries = $entries;
    }
}
