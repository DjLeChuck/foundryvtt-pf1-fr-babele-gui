<?php

declare(strict_types=1);

namespace App\Serializer\Callback;

use App\Entity\TermMythicPath;
use App\Entity\TermTranslationMythicPath;

class MythicPathCallback implements CallbackInterface
{
    public function supports(string $pack): bool
    {
        return 'mythic-paths' === $pack;
    }

    /**
     * @param TermMythicPath[] $terms
     *
     * @return array
     */
    public function process(iterable $terms): array
    {
        $entries = [];

        foreach ($terms as $term) {
            $name = $term->getName();

            /** @var TermTranslationMythicPath $translation */
            $translation = $term->getTranslation();
            $entries[$name] = array_filter([
                'name'        => $translation->getName() ?? $name,
                'description' => $translation->getDescription() ?? $term->getDescription(),
            ]);
        }

        return $entries;
    }
}
