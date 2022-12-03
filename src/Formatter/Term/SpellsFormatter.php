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

        $term->setDescription($dataset['data']['shortDescription'] ?? '');
        $term->setMaterials($dataset['data']['materials']['value'] ?? null);
        $term->setSubschool($dataset['data']['subschool'] ?? null);
        $term->setTypes($dataset['data']['types'] ?? null);
        $term->setLearnedAtClasses($this->getLearnedAt('class', $dataset));
        $term->setLearnedAtDomains($this->getLearnedAt('domain', $dataset));
        $term->setLearnedAtSubDomains($this->getLearnedAt('subDomain', $dataset));
        $term->setLearnedAtBloodlines($this->getLearnedAt('bloodline', $dataset));

        $this->setActions($term, $dataset);

        return $term;
    }

    protected function getEntityClass(): string
    {
        return TermSpell::class;
    }

    private function getLearnedAt(string $key, array $dataset): array
    {
        $learnedAt = [];

        foreach ($dataset['data']['learnedAt'][$key] as $learned) {
            $learnedAt[] = current($learned);
        }

        return $learnedAt;
    }
}
