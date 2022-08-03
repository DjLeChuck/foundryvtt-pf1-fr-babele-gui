<?php

namespace App\Formatter;

use App\DTO\Term;

class CommandFormatter implements TermFormatterInterface
{
    private const SUPPORTED_PACKS = ['sample-macros'];

    public function supports(string $pack): bool
    {
        return \in_array($pack, self::SUPPORTED_PACKS, true);
    }

    public function format(array $dataset): Term
    {
        return new Term($dataset['name'], $dataset['command']);
    }
}
