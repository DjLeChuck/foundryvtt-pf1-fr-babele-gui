<?php

namespace App\Formatter;

use App\DTO\Term;

class DataDescriptionValueFormatter implements TermFormatterInterface
{
    private const SUPPORTED_PACKS = [
        'armors-and-shields', 'class-abilities', 'classes', 'commonbuffs',
        'feats', 'items', 'monster-templates', 'mythic-paths', 'races',
        'racial-hd', 'weapons-and-ammo',
        // Bestiaries
        'bestiary-00', 'bestiary-02', 'bestiary-04', 'bestiary-06',
        'bestiary-08', 'bestiary-11', 'bestiary-15', 'bestiary-20',
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
