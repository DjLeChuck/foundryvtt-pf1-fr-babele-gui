<?php

namespace App\DTO\Export;

class MythicPaths
{
    public string $label = 'Voies mythiques';
    public array $entries;

    public function __construct(array $entries)
    {
        $this->entries = $entries;
    }
}
