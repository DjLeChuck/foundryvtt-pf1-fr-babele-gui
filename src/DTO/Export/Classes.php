<?php

namespace App\DTO\Export;

class Classes
{
    public string $label = 'Classes';
    public array $entries;

    public function __construct(array $entries)
    {
        $this->entries = $entries;
    }
}
