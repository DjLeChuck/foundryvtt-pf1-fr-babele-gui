<?php

namespace App\Formatter\Term;

use App\Entity\TermInterface;
use App\Entity\TermRacialHd;
use App\Repository\TermRacialHdRepository;

class RacialHdFormatter extends AbstractFormatter
{
    public function __construct(TermRacialHdRepository $repository)
    {
        $this->repository = $repository;
    }

    public function supports(string $pack): bool
    {
        return 'racial-hd' === $pack;
    }

    public function format(string $pack, array $dataset): TermInterface
    {
        /** @var TermRacialHd $term */
        $term = $this->getEntity($pack, $dataset);

        $term->setDescription($dataset['data']['description']['value'] ?? '');

        return $term;
    }

    protected function getEntityClass(): string
    {
        return TermRacialHd::class;
    }
}
