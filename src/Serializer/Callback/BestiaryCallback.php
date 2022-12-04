<?php

declare(strict_types=1);

namespace App\Serializer\Callback;

use App\Entity\TermBestiary;
use App\Entity\TermTranslationBestiary;

class BestiaryCallback implements CallbackInterface
{
    public function supports(string $pack): bool
    {
        return str_starts_with($pack, 'bestiary-');
    }

    /**
     * @param TermBestiary[] $terms
     *
     * @return array
     */
    public function process(iterable $terms): array
    {
        $entries = [];

        foreach ($terms as $term) {
            $name = $term->getName();

            /** @var TermTranslationBestiary $translation */
            $translation = $term->getTranslation();
            $entries[$name] = array_filter([
                'name'        => $translation->getName() ?? $name,
                'description' => $translation->getDescription() ?? $term->getDescription(),
            ]);
        }

        return $entries;
    }
}
