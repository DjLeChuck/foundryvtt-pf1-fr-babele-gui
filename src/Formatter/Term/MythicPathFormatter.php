<?php

namespace App\Formatter\Term;

use App\Entity\TermInterface;
use App\Entity\TermMythicPath;
use App\Repository\TermMythicPathRepository;

class MythicPathFormatter extends AbstractFormatter
{
    public function __construct(TermMythicPathRepository $repository)
    {
        $this->repository = $repository;
    }

    public function supports(string $pack): bool
    {
        return 'mythic-paths' === $pack;
    }

    public function format(string $pack, array $dataset): TermInterface
    {
        /** @var TermMythicPath $term */
        $term = $this->getEntity($pack, $dataset);

        $term->setDescription($dataset['data']['description']['value'] ?? '');

        return $term;
    }

    protected function getEntityClass(): string
    {
        return TermMythicPath::class;
    }
}
