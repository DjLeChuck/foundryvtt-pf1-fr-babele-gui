<?php

namespace App\Repository;

use App\Entity\Term;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Term>
 *
 * @method Term|null find($id, $lockMode = null, $lockVersion = null)
 * @method Term|null findOneBy(array $criteria, array $orderBy = null)
 * @method Term[]    findAll()
 * @method Term[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TermRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Term::class);
    }

    public function add(Term $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Term $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findPartialByPack(string $pack): array
    {
        $qb = $this->createQueryBuilder('o');
        $qb
            ->select('PARTIAL o.{id, name}')
            ->where('o.pack = :pack')
            ->setParameter('pack', $pack)
        ;

        return $qb->getQuery()->setHint(Query::HINT_FORCE_PARTIAL_LOAD, 1)->getResult();
    }

    public function findPartialWithTranslationByPack(string $pack): array
    {
        $qb = $this->createQueryBuilder('o');
        $qb
            ->select('PARTIAL o.{id, name}, t')
            ->leftJoin('o.translation', 't')
            ->where('o.pack = :pack')
            ->setParameter('pack', $pack)
        ;

        return $qb->getQuery()->setHint(Query::HINT_FORCE_PARTIAL_LOAD, 1)->getResult();
    }

    public function findWithTranslation(int $id): ?Term
    {
        $qb = $this->createQueryBuilder('o');
        $qb
            ->select('o, t')
            ->leftJoin('o.translation', 't')
            ->where('o = :term')
            ->setParameter('term', $id)
        ;

        return $qb->getQuery()->getOneOrNullResult();
    }

    public function getByPackQuery(string $pack, ?string $filter): Query
    {
        $qb = $this->createQueryBuilder('o');
        $qb
            ->addSelect('t')
            ->leftJoin('o.translation', 't')
            ->where('o.pack = :pack')
            ->orderBy('o.name')
            ->setParameter('pack', $pack)
        ;

        if (null !== $filter) {
            $qb
                ->andWhere($qb->expr()->orX('LOWER(o.name) LIKE :filter', 'LOWER(t.name) LIKE :filter'))
                ->setParameter('filter', mb_strtolower('%'.$filter.'%'))
            ;
        }

        return $qb->getQuery();
    }

    public function findPacks(): array
    {
        $qb = $this->createQueryBuilder('o');
        $qb
            ->distinct()
            ->select('o.pack')
            ->orderBy('o.pack')
        ;

        return array_map(static fn(array $row) => $row['pack'], $qb->getQuery()->getArrayResult());
    }
}
