<?php

namespace App\Repository;

use App\Entity\TermTranslation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<TermTranslation>
 *
 * @method TermTranslation|null find($id, $lockMode = null, $lockVersion = null)
 * @method TermTranslation|null findOneBy(array $criteria, array $orderBy = null)
 * @method TermTranslation[]    findAll()
 * @method TermTranslation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TermTranslationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TermTranslation::class);
    }

    public function add(TermTranslation $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(TermTranslation $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
}
