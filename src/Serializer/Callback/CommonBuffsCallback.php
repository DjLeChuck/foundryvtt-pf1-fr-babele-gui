<?php

declare(strict_types=1);

namespace App\Serializer\Callback;

use App\Entity\TermCommonBuff;
use App\Entity\TermTranslationCommonBuff;

class CommonBuffsCallback implements CallbackInterface
{
    public function supports(string $pack): bool
    {
        return 'commonbuffs' === $pack;
    }

    /**
     * @param TermCommonBuff[] $terms
     *
     * @return array
     */
    public function process(iterable $terms): array
    {
        $entries = [];

        foreach ($terms as $term) {
            $name = $term->getName();

            /** @var TermTranslationCommonBuff $translation */
            $translation = $term->getTranslation();
            $entries[$name] = [
                'name'            => $translation->getName() ?? $name,
                'description'     => $translation->getDescription() ?? $term->getDescription(),
                'contextNotes'    => $translation->getContextNotes() ?? $term->getContextNotes(),
                'flagsDictionary' => $translation->getDictionaryFlags() ?? $term->getDictionaryFlags(),
            ];
        }

        return $entries;
    }
}
