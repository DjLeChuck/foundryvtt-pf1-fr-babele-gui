<?php

declare(strict_types=1);

namespace App\Serializer\Callback;

use App\Entity\TermTranslationWeaponAndAmmo;
use App\Entity\TermWeaponAndAmmo;

class WeaponAndAmmoCallback implements CallbackInterface
{
    public function supports(string $pack): bool
    {
        return 'weapons-and-ammo' === $pack;
    }

    /**
     * @param TermWeaponAndAmmo[] $terms
     *
     * @return array
     */
    public function process(iterable $terms): array
    {
        $entries = [];

        foreach ($terms as $term) {
            $name = $term->getName();

            /** @var TermTranslationWeaponAndAmmo $translation */
            $translation = $term->getTranslation();
            $entries[$name] = array_filter([
                'name'         => $translation->getName() ?? $name,
                'description'  => $translation->getDescription() ?? $term->getDescription(),
                'contextNotes' => $translation->getContextNotes() ?? $term->getContextNotes(),
            ]);
        }

        return $entries;
    }
}
