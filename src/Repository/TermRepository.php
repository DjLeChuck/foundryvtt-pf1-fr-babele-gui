<?php

namespace App\Repository;

use App\DTO\FilterPack;
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
    public const PACK_SPELLS = 'spells';

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

    public function findAllWithTranslations(): array
    {
        $qb = $this->createQueryBuilder('o');
        $qb
            ->addSelect('t')
            ->leftJoin('o.translation', 't')
        ;

        return $qb->getQuery()->getResult();
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

    /**
     * @param array $ids
     *
     * @return Term[]
     */
    public function findMultipleWithTranslation(array $ids): array
    {
        $qb = $this->createQueryBuilder('o');
        $qb
            ->select('o, t')
            ->leftJoin('o.translation', 't')
            ->where('o IN (:ids)')
            ->setParameter('ids', $ids)
        ;

        return $qb->getQuery()->getResult();
    }

    public function getByPackQuery(FilterPack $filter): Query
    {
        $qb = $this->createQueryBuilder('o');
        $qb
            ->addSelect('t')
            ->leftJoin('o.translation', 't')
            ->where('o.pack = :pack')
            ->orderBy('o.name')
            ->setParameter('pack', $filter->getPack())
        ;

        if (null !== $filter->getTerm()) {
            $qb
                ->andWhere($qb->expr()->orX('LOWER(o.name) LIKE :filter', 'LOWER(t.name) LIKE :filter'))
                ->setParameter('filter', mb_strtolower('%'.$filter->getTerm().'%'))
            ;
        }

        if ($filter->onlyUntranslated()) {
            $qb->andWhere(
                '(o.name = t.name OR (o.description != \'\' AND t.description = \'\')) AND t.approved = FALSE'
            );
        }

        return $qb->getQuery();
    }

    public function getGlobalSearchQuery(string $term): Query
    {
        $qb = $this->createQueryBuilder('o');
        $qb
            ->addSelect('t')
            ->leftJoin('o.translation', 't')
            ->where($qb->expr()->orX('LOWER(o.name) LIKE :filter', 'LOWER(t.name) LIKE :filter'))
            ->orderBy('o.name')
            ->setParameter('filter', mb_strtolower('%'.$term.'%'))
        ;

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

    public function getStatisticsByPack(): array
    {
        $qb = $this->createQueryBuilder('o');
        $qb
            ->select(
                'o.pack',
                'COUNT(o.id) AS total',
                'SUM(CASE WHEN (o.name = t.name AND t.approved = FALSE) OR t.id IS NULL THEN 1 ELSE 0 END) untranslated',
                'SUM(CASE WHEN o.name != t.name OR t.approved = TRUE THEN 1 ELSE 0 END) translated'
            )
            ->leftJoin('o.translation', 't')
            ->groupBy('o.pack')
            ->orderBy('o.pack')
        ;

        return $qb->getQuery()->getArrayResult();
    }

    public function findSpellsWithDescription(): array
    {
        $qb = $this->createQueryBuilder('o');
        $qb
            ->select('PARTIAL o.{id, name}, t')
            ->innerJoin('o.translation', 't')
            ->where('o.pack = :pack')
            ->andWhere('t.description IS NOT NULL')
            ->setParameter('pack', self::PACK_SPELLS)
        ;

        return $qb->getQuery()->setHint(Query::HINT_FORCE_PARTIAL_LOAD, 1)->getResult();
    }

    public function findByPackForExport(string $pack): array
    {
        $qb = $this->createQueryBuilder('o', 'o.name');
        $qb
            ->select(
                'o.name term, coalesce(t.name, o.name) as name, coalesce(t.description, o.description) as description'
            )
            ->leftJoin('o.translation', 't')
            ->where('o.pack = :pack')
            ->orderBy('o.name')
            ->setParameter('pack', $pack)
        ;

        return $qb->getQuery()->getArrayResult();
    }

    public function fetchMatchingBestiary(): array
    {
        return $this->_em
            ->getConnection()
            ->executeQuery(
                <<<SQL
SELECT a.id term_id, b.name_fr
FROM app_term a
INNER JOIN bestiary b ON a.name = b.name_en
WHERE a.pack LIKE 'bestiary%'
SQL
            )
            ->fetchAllAssociative()
        ;
    }

    public function findWithoutTranslation(): array
    {
        $qb = $this->createQueryBuilder('o');
        $qb
            ->leftJoin('o.translation', 't')
            ->where('t IS NULL')
        ;

        return $qb->getQuery()->getResult();
    }
}
