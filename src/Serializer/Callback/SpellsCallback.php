<?php

declare(strict_types=1);

namespace App\Serializer\Callback;

use App\Entity\TermSpell;
use App\Entity\TermTranslationSpell;

class SpellsCallback implements CallbackInterface
{
    public function supports(string $pack): bool
    {
        return 'spells' === $pack;
    }

    /**
     * @param TermSpell[] $terms
     *
     * @return array
     */
    public function process(iterable $terms): array
    {
        $entries = [];

        foreach ($terms as $term) {
            $name = $term->getName();

            /** @var TermTranslationSpell $translation */
            $translation = $term->getTranslation();
            $entries[$name] = [
                'name'               => $translation->getName() ?? $name,
                'description'        => $translation->getDescription() ?? $term->getDescription(),
                'actions'            => $translation->getActions() ?? $term->getActions(),
                'learnedAtClass'     => $translation->getLearnedAtClasses() ?? $term->getLearnedAtClasses(),
                'learnedAtDomain'    => $translation->getLearnedAtDomains() ?? $term->getLearnedAtDomains(),
                'learnedAtSubdomain' => $translation->getLearnedAtSubdomains() ?? $term->getLearnedAtSubdomains(),
                'learnedAtBloodline' => $translation->getLearnedAtBloodlines() ?? $term->getLearnedAtBloodlines(),
                'materials'          => $translation->getMaterials() ?? $term->getMaterials(),
                'subschool'          => $translation->getSubschool() ?? $term->getSubschool(),
                'types'              => $translation->getTypes() ?? $term->getTypes(),
            ];
        }

        return $entries;
    }
}
