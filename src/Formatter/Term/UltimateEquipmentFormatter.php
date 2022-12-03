<?php

namespace App\Formatter\Term;

use App\Entity\TermInterface;
use App\Entity\TermUltimateEquipment;
use App\Repository\TermUltimateEquipmentRepository;

class UltimateEquipmentFormatter extends AbstractFormatter
{
    public function __construct(TermUltimateEquipmentRepository $repository)
    {
        $this->repository = $repository;
    }

    public function supports(string $pack): bool
    {
        return 'ultimate-equipment' === $pack;
    }

    public function format(string $pack, array $dataset): TermInterface
    {
        /** @var TermUltimateEquipment $term */
        $term = $this->getEntity($pack, $dataset);

        $term->setDescription($dataset['data']['description']['value'] ?? '');

        $results = [];
        foreach ($dataset['results'] ?? [] as $result) {
            $results[] = $result['text'];
        }
        $term->setResults($results);

        return $term;
    }

    protected function getEntityClass(): string
    {
        return TermUltimateEquipment::class;
    }
}
