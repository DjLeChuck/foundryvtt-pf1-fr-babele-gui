<?php

namespace App\Formatter\Term;

use App\Entity\TermFeat;
use App\Entity\TermInterface;
use App\Repository\TermFeatRepository;

class FeatsFormatter extends AbstractFormatter
{
    public function __construct(TermFeatRepository $repository)
    {
        $this->repository = $repository;
    }

    public function supports(string $pack): bool
    {
        return 'feats' === $pack;
    }

    public function format(string $pack, array $dataset): TermInterface
    {
        /** @var TermFeat $term */
        $term = $this->getEntity($pack, $dataset);

        $actions = [];
        foreach ($dataset['data']['actions'] as $action) {
            $actions[] = [
                'name'        => $action['name'],
                'duration'    => $action['duration']['value'] ?? '',
                'save'        => $action['save']['description'],
                'spellEffect' => $action['spellEffect'],
                'spellArea'   => $action['spellArea'],
                'effectNotes' => $action['effectNotes'],
                'target'      => $action['target']['value'] ?? '',
            ];
        }
        $term->setActions($actions);

        $contextNotes = [];
        foreach ($dataset['data']['contextNotes'] ?? [] as $note) {
            $contextNotes[] = $note['text'];
        }
        $term->setContextNotes($contextNotes);

        $tags = [];
        foreach ($dataset['data']['tags'] ?? [] as $tag) {
            $tags[] = current($tag);
        }
        $term->setTags($tags);

        $term->setDescription($dataset['data']['description']['value'] ?? '');
        $term->setCustomWeaponProf(array_filter(explode(';', $dataset['data']['weaponProf']['custom'] ?? '')));

        return $term;
    }

    protected function getEntityClass(): string
    {
        return TermFeat::class;
    }
}
