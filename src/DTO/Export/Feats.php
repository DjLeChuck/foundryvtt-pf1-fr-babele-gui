<?php

namespace App\DTO\Export;

class Feats
{
    public string $label = 'Dons';
    public array $entries;

    public function __construct(array $entries)
    {
        $this->entries = $entries;
    }
}
