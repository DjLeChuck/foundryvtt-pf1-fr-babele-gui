<?php

declare(strict_types=1);

namespace App\Serializer\Callback;

use App\Entity\TermRace;
use App\Entity\TermTranslationRace;

class RacesCallback implements CallbackInterface
{
    public function supports(string $pack): bool
    {
        return 'races' === $pack;
    }

    /**
     * @param TermRace[] $terms
     *
     * @return array
     */
    public function process(iterable $terms): array
    {
        $entries = [];

        foreach ($terms as $term) {
            $name = $term->getName();

            /** @var TermTranslationRace $translation */
            $translation = $term->getTranslation();
            $entries[$name] = array_filter([
                'name'            => $translation->getName() ?? $name,
                'description'     => $translation->getDescription() ?? $term->getDescription(),
                'contextNotes'    => $translation->getContextNotes() ?? $term->getContextNotes(),
                'subTypes'        => $translation->getSubTypes() ?? $term->getSubTypes(),
                'customLanguages' => implode(
                    ';',
                        $translation->getCustomLanguages() ?? $term->getCustomLanguages() ?: []
                ),
            ]);
        }

        return $entries;
    }
}
