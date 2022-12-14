<?php

declare(strict_types=1);

namespace App\DTO\Export;

class PF1ERules
{
    public string $label = 'Pathfinder 1e - Règles';
    public iterable $entries;

    public function __construct(iterable $entries)
    {
        $this->entries = $entries;
    }
}
