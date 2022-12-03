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

        $term->setDescription($dataset['data']['description']['value'] ?? '');
        $term->setCustomWeaponProf(array_filter(explode(';', $dataset['data']['weaponProf']['custom'] ?? '')));

        $this->setActions($term, $dataset);
        $this->setContextNotes($term, $dataset);
        $this->setTags($term, $dataset);

        return $term;
    }

    protected function getEntityClass(): string
    {
        return TermFeat::class;
    }
}
