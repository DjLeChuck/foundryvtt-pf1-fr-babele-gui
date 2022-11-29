<?php

declare(strict_types=1);

namespace App\Formatter\Term;

use App\Entity\TermClass;
use App\Entity\TermInterface;
use App\Formatter\TermFormatterInterface;
use App\Repository\TermRepositoryInterface;

abstract class AbstractFormatter implements TermFormatterInterface
{
    /** @var TermClass[]|null */
    protected ?array $existing = null;

    protected TermRepositoryInterface $repository;

    abstract protected function getEntityClass(): string;

    protected function getEntity(string $pack, array $dataset): TermInterface
    {
        $this->warmup();

        foreach ($this->existing as $existing) {
            if ($existing->getPackId() === $dataset['_id'] || $existing->getName() === $dataset['name']) {
                $this->setPackId($existing, $dataset);

                return $existing;
            }
        }

        /** @var TermInterface $term */
        $term = new ($this->getEntityClass())();
        $term->setPack($pack);
        $term->setName($dataset['name']);

        $this->setPackId($term, $dataset);

        return $term;
    }

    protected function warmup(): void
    {
        if (null === $this->existing) {
            $this->existing = $this->repository->findAllWithTranslations();
        }
    }

    private function setPackId(TermInterface $term, array $dataset): void
    {
        if (!isset($dataset['_id'])) {
            return;
        }

        $term->setPackId($dataset['_id']);
    }
}
