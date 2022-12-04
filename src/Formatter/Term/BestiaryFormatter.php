<?php

namespace App\Formatter\Term;

use App\Entity\TermBestiary;
use App\Entity\TermInterface;
use App\Repository\TermBestiaryRepository;

class BestiaryFormatter extends AbstractFormatter
{
    public function __construct(TermBestiaryRepository $repository)
    {
        $this->repository = $repository;
    }

    public function supports(string $pack): bool
    {
        return str_starts_with($pack, 'bestiary-');
    }

    public function format(string $pack, array $dataset): TermInterface
    {
        /** @var TermBestiary $term */
        $term = $this->getEntity($pack, $dataset);

        $term->setDescription($dataset['data']['description']['value'] ?? '');

        return $term;
    }

    protected function getEntityClass(): string
    {
        return TermBestiary::class;
    }
}
