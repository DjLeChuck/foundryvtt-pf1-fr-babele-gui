<?php

namespace App\DTO\Export;

class Bestiary
{
    public string $label = '__OVERRIDE__';
    public array $mapping = [
        'img'   => 'img',
        'token' => 'prototypeToken.texture.src',
    ];
    public iterable $entries;

    public function __construct(iterable $entries)
    {
        $this->entries = $entries;
    }
}
