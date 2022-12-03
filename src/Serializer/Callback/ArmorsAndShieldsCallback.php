<?php

declare(strict_types=1);

namespace App\Serializer\Callback;

use App\Entity\TermArmorAndShield;
use App\Entity\TermTranslationArmorAndShield;

class ArmorsAndShieldsCallback implements CallbackInterface
{
    public function supports(string $pack): bool
    {
        return 'armors-and-shields' === $pack;
    }

    /**
     * @param TermArmorAndShield[] $terms
     *
     * @return array
     */
    public function process(iterable $terms): array
    {
        $entries = [];

        foreach ($terms as $term) {
            $name = $term->getName();

            /** @var TermTranslationArmorAndShield $translation */
            $translation = $term->getTranslation();
            $entries[$name] = array_filter([
                'name'        => $translation->getName() ?? $name,
                'description' => $translation->getDescription() ?? $term->getDescription(),
            ]);
        }

        return $entries;
    }
}
