<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\TermItem;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class TermItemRepository extends ServiceEntityRepository implements TermRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TermItem::class);
    }

    public function findAllWithTranslations(): array
    {
        $qb = $this->createQueryBuilder('o');
        $qb
            ->addSelect('t')
            ->leftJoin('o.translation', 't')
            ->where('o INSTANCE OF :type')
            ->setParameter('type', 'items')
        ;

        return $qb->getQuery()->getResult();
    }
}
