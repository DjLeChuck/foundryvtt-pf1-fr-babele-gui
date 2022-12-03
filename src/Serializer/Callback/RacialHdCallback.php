<?php

declare(strict_types=1);

namespace App\Serializer\Callback;

use App\Entity\TermRacialHd;
use App\Entity\TermTranslationRacialHd;

class RacialHdCallback implements CallbackInterface
{
    public function supports(string $pack): bool
    {
        return 'racial-hd' === $pack;
    }

    /**
     * @param TermRacialHd[] $terms
     *
     * @return array
     */
    public function process(iterable $terms): array
    {
        $entries = [];

        foreach ($terms as $term) {
            $name = $term->getName();

            /** @var TermTranslationRacialHd $translation */
            $translation = $term->getTranslation();
            $entries[$name] = array_filter([
                'name'        => $translation->getName() ?? $name,
                'description' => $translation->getDescription() ?? $term->getDescription(),
            ]);
        }

        return $entries;
    }
}
