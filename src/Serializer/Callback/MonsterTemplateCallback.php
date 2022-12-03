<?php

declare(strict_types=1);

namespace App\Serializer\Callback;

use App\Entity\TermMonsterTemplate;
use App\Entity\TermTranslationMonsterTemplate;

class MonsterTemplateCallback implements CallbackInterface
{
    public function supports(string $pack): bool
    {
        return 'monster-templates' === $pack;
    }

    /**
     * @param TermMonsterTemplate[] $terms
     *
     * @return array
     */
    public function process(iterable $terms): array
    {
        $entries = [];

        foreach ($terms as $term) {
            $name = $term->getName();

            /** @var TermTranslationMonsterTemplate $translation */
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
