<?php

declare(strict_types=1);

namespace App\Serializer\Callback;

use App\Entity\TermFeat;
use App\Entity\TermTranslationFeat;

class FeatsCallback implements CallbackInterface
{
    public function supports(string $pack): bool
    {
        return 'feats' === $pack;
    }

    /**
     * @param TermFeat[] $terms
     *
     * @return array
     */
    public function process(iterable $terms): array
    {
        $entries = [];

        foreach ($terms as $term) {
            $name = $term->getName();

            /** @var TermTranslationFeat $translation */
            $translation = $term->getTranslation();
            $entries[$name] = [
                'name'             => $translation->getName() ?? $name,
                'description'      => $translation->getDescription() ?? $term->getDescription(),
                'actions'          => $translation->getActions() ?? $term->getActions(),
                'contextNotes'     => $translation->getContextNotes() ?? $term->getContextNotes(),
                'customWeaponProf' => $translation->getCustomWeaponProf() ?? $term->getCustomWeaponProf(),
                'tags'             => $translation->getTags() ?? $term->getTags(),
            ];
        }

        return $entries;
    }
}
