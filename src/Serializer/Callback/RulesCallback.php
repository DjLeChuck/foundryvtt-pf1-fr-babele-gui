<?php

declare(strict_types=1);

namespace App\Serializer\Callback;

use App\Entity\TermJournal;
use App\Entity\TermTranslationJournal;

class RulesCallback implements CallbackInterface
{
    public function supports(string $pack): bool
    {
        return 'pf1e-rules' === $pack;
    }

    /**
     * @param TermJournal[] $terms
     *
     * @return array
     */
    public function process(iterable $terms): array
    {
        $entries = [];

        foreach ($terms as $term) {
            $name = $term->getName();

            /** @var TermTranslationJournal $translation */
            $translation = $term->getTranslation();
            $pages = [];

            foreach ($translation->getEntries() as $entry) {
                $entryTerm = $entry->getTerm();
                if (null === $entryTerm) {
                    continue;
                }

                $termName = $entryTerm->getName();
                $pages[$termName] = [
                    'name' => $entry->getName() ?? $termName,
                    'text' => $entry->getDescription() ?? $entryTerm->getDescription(),
                ];
            }

            $entries[$name] = array_filter([
                'name'  => $translation->getName() ?? $name,
                'pages' => $pages,
            ]);
        }

        return $entries;
    }
}
