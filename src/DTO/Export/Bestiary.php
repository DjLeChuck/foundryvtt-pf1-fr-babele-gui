<?php

namespace App\DTO\Export;

class Bestiary
{
    public string $label = '__OVERRIDE__';
    public array $mapping = [
        'img'   => [
            'path'      => 'img',
            'converter' => 'pf2TokensBestiaries',
        ],
        'token' => [
            'path'      => 'prototypeToken.texture.src',
            'converter' => 'pf2TokensBestiaries',
        ],
    ];
    public iterable $entries;

    public function __construct(iterable $entries)
    {
        $this->entries = $entries;
    }
}
