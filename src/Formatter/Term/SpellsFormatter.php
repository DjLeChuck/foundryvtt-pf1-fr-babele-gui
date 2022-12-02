<?php

namespace App\Formatter\Term;

use App\Entity\TermInterface;
use App\Entity\TermSpell;
use App\Repository\TermSpellRepository;

class SpellsFormatter extends AbstractFormatter
{
    public function __construct(TermSpellRepository $repository)
    {
        $this->repository = $repository;
    }

    public function supports(string $pack): bool
    {
        return 'spells' === $pack;
    }

    public function format(string $pack, array $dataset): TermInterface
    {
        /** @var TermSpell $term */
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

        $learnedAt = [];
        foreach ($dataset['data']['learnedAt']['class'] as $learned) {
            $learnedAt[] = current($learned);
        }
        $term->setLearnedAtClasses($learnedAt);

        $learnedAt = [];
        foreach ($dataset['data']['learnedAt']['domain'] as $learned) {
            $learnedAt[] = current($learned);
        }
        $term->setLearnedAtDomains($learnedAt);

        $learnedAt = [];
        foreach ($dataset['data']['learnedAt']['subDomain'] as $learned) {
            $learnedAt[] = current($learned);
        }
        $term->setLearnedAtSubDomains($learnedAt);

        $learnedAt = [];
        foreach ($dataset['data']['learnedAt']['bloodline'] as $learned) {
            $learnedAt[] = current($learned);
        }
        $term->setLearnedAtBloodlines($learnedAt);

        $term->setDescription($dataset['data']['shortDescription'] ?? '');
        $term->setMaterials($dataset['data']['materials']['value'] ?? null);
        $term->setSubschool($dataset['data']['subschool'] ?? null);
        $term->setTypes($dataset['data']['types'] ?? null);

        return $term;
    }

    protected function getEntityClass(): string
    {
        return TermSpell::class;
    }
}
