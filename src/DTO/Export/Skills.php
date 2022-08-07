<?php

namespace App\DTO\Export;

class Skills
{
    public string $label = 'Compétences';
    public array $entries;

    public function __construct(array $entries)
    {
        $this->entries = $entries;
    }
}
