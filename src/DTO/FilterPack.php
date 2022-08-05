<?php

namespace App\DTO;

class FilterPack
{
    private string $pack;
    private ?string $term = null;
    private bool $onlyUntranslated = false;

    public function __construct(string $pack)
    {
        $this->pack = $pack;
    }

    public function getPack(): string
    {
        return $this->pack;
    }

    public function getTerm(): ?string
    {
        return $this->term;
    }

    public function setTerm(?string $term): void
    {
        $this->term = $term;
    }

    public function onlyUntranslated(): bool
    {
        return $this->onlyUntranslated;
    }

    public function setOnlyUntranslated(bool $onlyUntranslated): void
    {
        $this->onlyUntranslated = $onlyUntranslated;
    }
}
