<?php

namespace App\Formatter\Term;

use App\Entity\TermInterface;
use App\Entity\TermMonsterTemplate;
use App\Repository\TermMonsterTemplateRepository;

class MonsterTemplateFormatter extends AbstractFormatter
{
    public function __construct(TermMonsterTemplateRepository $repository)
    {
        $this->repository = $repository;
    }

    public function supports(string $pack): bool
    {
        return 'monster-templates' === $pack;
    }

    public function format(string $pack, array $dataset): TermInterface
    {
        /** @var TermMonsterTemplate $term */
        $term = $this->getEntity($pack, $dataset);

        $term->setDescription($dataset['data']['description']['value'] ?? '');

        $this->setContextNotes($term, $dataset);

        return $term;
    }

    protected function getEntityClass(): string
    {
        return TermMonsterTemplate::class;
    }
}
