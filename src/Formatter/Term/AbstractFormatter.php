<?php

declare(strict_types=1);

namespace App\Formatter\Term;

use App\Entity\TermClass;
use App\Entity\TermInterface;
use App\Formatter\TermFormatterInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

abstract class AbstractFormatter implements TermFormatterInterface
{
    /** @var TermClass[]|null */
    protected static ?array $existing = null;

    protected ServiceEntityRepository $repository;

    abstract protected function getEntityClass(): string;

    protected function getEntity(string $pack, array $dataset): TermInterface
    {
        $this->warmup();

        foreach (static::$existing as $existing) {
            if ($existing->getName() === $dataset['name']) {
                return $existing;
            }
        }

        /** @var TermInterface $term */
        $term = new ($this->getEntityClass())();
        $term->setPack($pack);
        $term->setName($dataset['name']);

        return $term;
    }

    protected function warmup(): void
    {
        if (null === static::$existing) {
            static::$existing = $this->repository->findAll();
        }
    }
}
