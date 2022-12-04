<?php

namespace App\Formatter\Term;

use App\Entity\TermInterface;
use App\Entity\TermRace;
use App\Repository\TermRaceRepository;

class RacesFormatter extends AbstractFormatter
{
    public function __construct(TermRaceRepository $repository)
    {
        $this->repository = $repository;
    }

    public function supports(string $pack): bool
    {
        return 'races' === $pack;
    }

    public function format(string $pack, array $dataset): TermInterface
    {
        /** @var TermRace $term */
        $term = $this->getEntity($pack, $dataset);

        $term->setDescription($dataset['data']['description']['value'] ?? '');
        $term->setCustomLanguages(array_filter(explode(';', $dataset['data']['languages']['custom'] ?? '')));

        $this->setContextNotes($term, $dataset);

        $subTypes = [];
        foreach ($dataset['data']['subTypes'] ?? [] as $subType) {
            $subTypes[] = current($subType);
        }
        $term->setSubTypes($subTypes);

        return $term;
    }

    protected function getEntityClass(): string
    {
        return TermRace::class;
    }
}
