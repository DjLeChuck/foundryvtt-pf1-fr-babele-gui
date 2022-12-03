<?php

declare(strict_types=1);

namespace App\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

abstract class AbstractTermRepository extends ServiceEntityRepository implements TermRepositoryInterface
{
    public function findAllWithTranslations(): array
    {
        $qb = $this->createQueryBuilder('o');
        $qb
            ->addSelect('t')
            ->leftJoin('o.translation', 't')
            ->where('o INSTANCE OF :type')
            ->setParameter('type', $this->getType())
        ;

        return $qb->getQuery()->getResult();
    }

    public function findForExport(): iterable
    {
        $qb = $this->createQueryBuilder('o', 'o.name');
        $qb
            ->addSelect('t')
            ->leftJoin('o.translation', 't')
            ->where('o INSTANCE OF :type')
            ->setParameter('type', $this->getType())
            ->orderBy('o.name')
        ;

        return $qb->getQuery()->toIterable();
    }

    abstract protected function getType(): string;
}
