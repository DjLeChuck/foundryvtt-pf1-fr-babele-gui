<?php

namespace App\DTO\Export;

class MythicPaths
{
    public string $label = 'Voies mythiques';
    public iterable $entries;

    public function __construct(iterable $entries)
    {
        $this->entries = $entries;
    }
}
