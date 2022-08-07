<?php

namespace App\DTO\Export;

class Feats
{
    public static string $packName = 'pf1.feats.json';

    public string $label = 'Dons';
    public array $entries;

    public function __construct(array $entries)
    {
        $this->entries = $entries;
    }
}