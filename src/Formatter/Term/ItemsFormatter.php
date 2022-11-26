<?php

namespace App\Formatter\Term;

use App\Entity\TermInterface;
use App\Entity\TermItem;
use App\Repository\TermItemRepository;

class ItemsFormatter extends AbstractFormatter
{
    public function __construct(TermItemRepository $repository)
    {
        $this->repository = $repository;
    }

    public function supports(string $pack): bool
    {
        return 'items' === $pack;
    }

    public function format(string $pack, array $dataset): TermInterface
    {
        /** @var TermItem $term */
        $term = $this->getEntity($pack, $dataset);

        $term->setDescription($dataset['data']['description']['value'] ?? '');
        $term->setUnidentifiedName($dataset['data']['unidentified']['name'] ?? '');
        $term->setUnidentifiedDescription($dataset['data']['description']['unidentified'] ?? '');

        return $term;
    }

    protected function getEntityClass(): string
    {
        return TermItem::class;
    }
}
