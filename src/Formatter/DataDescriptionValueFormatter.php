<?php

namespace App\Formatter;

use App\DTO\Term;

class DataDescriptionValueFormatter implements TermFormatterInterface
{
    private const SUPPORTED_PACKS = [
        'armors-and-shields', 'class-abilities', 'classes', 'commonbuffs',
        'feats', 'items', 'monster-templates', 'mythic-paths', 'races',
        'racial-hd', 'weapons-and-ammo',
    ];

    public function supports(string $pack): bool
    {
        return \in_array($pack, self::SUPPORTED_PACKS, true);
    }

    public function format(array $dataset): Term
    {
        return new Term($dataset['name'], $dataset['data']['description']['value'] ?? '');
    }
}
