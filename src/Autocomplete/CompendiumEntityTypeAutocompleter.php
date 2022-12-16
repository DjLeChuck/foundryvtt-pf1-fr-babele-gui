<?php

declare(strict_types=1);

namespace App\Autocomplete;

use App\Entity\Term;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;
use Symfony\Component\Security\Core\Security;
use Symfony\UX\Autocomplete\EntityAutocompleterInterface;

class CompendiumEntityTypeAutocompleter implements EntityAutocompleterInterface
{
    public function __construct(
        private readonly EntityAutocompleterInterface $decorated
    ) {
    }

    public function getEntityClass(): string
    {
        return $this->decorated->getEntityClass();
    }

    public function createFilteredQueryBuilder(EntityRepository $repository, string $query): QueryBuilder
    {
        return $this->decorated->createFilteredQueryBuilder($repository, $query);
    }

    public function getLabel(object $entity): string
    {
        return $this->decorated->getLabel($entity);
    }

    /**
     * @param object<Term> $entity
     *
     * @return mixed
     */
    public function getValue(object $entity): mixed
    {
        return $entity->getCompendiumLinkTag();
    }

    public function isGranted(Security $security): bool
    {
        return $this->decorated->isGranted($security);
    }
}
