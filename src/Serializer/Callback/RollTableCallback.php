<?php

declare(strict_types=1);

namespace App\Serializer\Callback;

use App\Entity\TermRollTable;
use App\Entity\TermTranslationRollTable;

class RollTableCallback implements CallbackInterface
{
    public function supports(string $pack): bool
    {
        return 'roll-tables' === $pack;
    }

    /**
     * @param TermRollTable[] $terms
     *
     * @return array
     */
    public function process(iterable $terms): array
    {
        $entries = [];

        foreach ($terms as $term) {
            $name = $term->getName();

            /** @var TermTranslationRollTable $translation */
            $translation = $term->getTranslation();
            $entries[$name] = array_filter([
                'name'        => $translation->getName() ?? $name,
                'description' => $translation->getDescription() ?? $term->getDescription(),
                'results'     => $translation->getResults() ?? $term->getResults(),
            ]);
        }

        return $entries;
    }
}
