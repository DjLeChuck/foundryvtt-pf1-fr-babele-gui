<?php

namespace App\Formatter\Term;

use App\Entity\TermInterface;
use App\Entity\TermRollTable;
use App\Repository\TermRollTableRepository;

class RollTableFormatter extends AbstractFormatter
{
    public function __construct(TermRollTableRepository $repository)
    {
        $this->repository = $repository;
    }

    public function supports(string $pack): bool
    {
        return 'roll-tables' === $pack;
    }

    public function format(string $pack, array $dataset): TermInterface
    {
        /** @var TermRollTable $term */
        $term = $this->getEntity($pack, $dataset);

        $term->setDescription($dataset['description'] ?? '');
        $this->setResultsText($term, $dataset);

        return $term;
    }

    protected function getEntityClass(): string
    {
        return TermRollTable::class;
    }
}
