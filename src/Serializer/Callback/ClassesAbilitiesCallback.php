<?php

declare(strict_types=1);

namespace App\Serializer\Callback;

use App\Entity\TermClassAbility;
use App\Entity\TermTranslationClassAbility;

class ClassesAbilitiesCallback implements CallbackInterface
{
    public function supports(string $pack): bool
    {
        return 'class-abilities' === $pack;
    }

    /**
     * @param TermClassAbility[] $terms
     *
     * @return array
     */
    public function process(iterable $terms): array
    {
        $entries = [];

        foreach ($terms as $term) {
            $name = $term->getName();

            /** @var TermTranslationClassAbility $translation */
            $translation = $term->getTranslation();
            $entries[$name] = array_filter([
                'name'         => $translation->getName() ?? $name,
                'description'  => $translation->getDescription() ?? $term->getDescription(),
                'actions'      => $translation->getActions() ?? $term->getActions(),
                'contextNotes' => $translation->getContextNotes() ?? $term->getContextNotes(),
                'tags'         => $translation->getTags() ?? $term->getTags(),
                'classes'      => $translation->getClasses() ?? $term->getClasses(),
            ]);
        }

        return $entries;
    }
}
