<?php

namespace App\Formatter;

use App\Entity\TermInterface;
use App\Entity\TermItem;
use App\Repository\TermItemRepository;

class ItemsFormatter implements TermFormatterInterface
{
    private const SUPPORTED_PACKS = ['items'];

    private TermItemRepository $repository;

    /** @var TermItem[]|null */
    private static ?array $existing = null;

    public function __construct(TermItemRepository $repository)
    {
        $this->repository = $repository;
    }

    public function supports(string $pack): bool
    {
        return \in_array($pack, self::SUPPORTED_PACKS, true);
    }

    public function format(string $pack, array $dataset): TermInterface
    {
        $term = $this->getEntity($pack, $dataset);

        $term->setDescription($dataset['data']['description']['value'] ?? '');
        $term->setUnidentifiedName($dataset['data']['unidentified']['name'] ?? '');
        $term->setUnidentifiedDescription($dataset['data']['description']['unidentified'] ?? '');

        return $term;
    }

    private function getEntity(string $pack, array $dataset): TermItem
    {
        $this->warmup();

        foreach (static::$existing as $existing) {
            if ($existing->getName() === $dataset['name']) {
                return $existing;
            }
        }

        $term = new TermItem();
        $term->setPack($pack);
        $term->setName($dataset['name']);

        return $term;
    }

    private function warmup(): void
    {
        if (null === static::$existing) {
            static::$existing = $this->repository->findAll();
        }
    }
}
