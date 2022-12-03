<?php

declare(strict_types=1);

namespace App\Serializer\Callback;

use App\Entity\TermTranslationUltimateEquipment;
use App\Entity\TermUltimateEquipment;

class UltimateEquipmentCallback implements CallbackInterface
{
    public function supports(string $pack): bool
    {
        return 'ultimate-equipment' === $pack;
    }

    /**
     * @param TermUltimateEquipment[] $terms
     *
     * @return array
     */
    public function process(iterable $terms): array
    {
        $entries = [];

        foreach ($terms as $term) {
            $name = $term->getName();

            /** @var TermTranslationUltimateEquipment $translation */
            $translation = $term->getTranslation();
            $entries[$name] = array_filter([
                'name'    => $translation->getName() ?? $name,
                'results' => $translation->getResults() ?? $term->getResults(),
            ]);
        }

        return $entries;
    }
}
