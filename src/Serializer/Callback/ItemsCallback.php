<?php

declare(strict_types=1);

namespace App\Serializer\Callback;

use App\Entity\TermItem;
use App\Entity\TermTranslationItem;

class ItemsCallback implements CallbackInterface
{
    public function supports(string $pack): bool
    {
        return 'items' === $pack;
    }

    /**
     * @param TermItem[] $terms
     *
     * @return array
     */
    public function process(iterable $terms): array
    {
        $entries = [];

        foreach ($terms as $term) {
            $name = $term->getName();

            /** @var TermTranslationItem $translation */
            $translation = $term->getTranslation();
            $entries[$name] = [
                'name'                    => $translation->getName() ?? $name,
                'description'             => $translation->getDescription() ?? $term->getDescription(),
                'unidentifiedDescription' => $translation->getUnidentifiedDescription()
                    ?? $term->getUnidentifiedDescription(),
                'unidentifiedName'        => $translation->getUnidentifiedName() ?? $term->getUnidentifiedName(),
            ];
        }

        return $entries;
    }
}
