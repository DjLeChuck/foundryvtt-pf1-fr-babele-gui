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

        $contextNotes = [];
        $subTypes = [];

        foreach ($dataset['data']['contextNotes'] ?? [] as $note) {
            $contextNotes[] = $note['text'];
        }

        foreach ($dataset['data']['subTypes'] ?? [] as $subType) {
            $subTypes[] = current($subType);
        }

        $term->setDescription($dataset['data']['description']['value'] ?? '');
        $term->setSubTypes(!empty($subTypes) ? $subTypes : null);
        $term->setContextNotes(!empty($contextNotes) ? $contextNotes : null);

        return $term;
    }

    protected function getEntityClass(): string
    {
        return TermRace::class;
    }
}
