<?php

namespace App\DTO\Export;

class Skills
{
    public string $label = 'Compétences';
    public iterable $entries;

    public function __construct(iterable $entries)
    {
        $this->entries = $entries;
    }
}
