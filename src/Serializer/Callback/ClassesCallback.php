<?php

declare(strict_types=1);

namespace App\Serializer\Callback;

use App\Entity\TermClass;
use App\Entity\TermTranslationClass;

class ClassesCallback implements CallbackInterface
{
    public function supports(string $pack): bool
    {
        return 'classes' === $pack;
    }

    /**
     * @param TermClass[] $terms
     *
     * @return array
     */
    public function process(iterable $terms): array
    {
        $entries = [];

        foreach ($terms as $term) {
            $name = $term->getName();

            /** @var TermTranslationClass $translation */
            $translation = $term->getTranslation();
            $entries[$name] = array_filter([
                'name'             => $translation->getName() ?? $name,
                'description'      => $translation->getDescription() ?? $term->getDescription(),
                'customWeaponProf' => implode(
                    ';',
                        $translation->getCustomWeaponProf() ?? $term->getCustomWeaponProf() ?: []
                ),
                'customArmorProf'  => implode(
                    ';',
                        $translation->getCustomArmorProf() ?? $term->getCustomArmorProf() ?: []
                ),
            ]);
        }

        return $entries;
    }
}
