<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\TermJournal;
use Doctrine\Persistence\ManagerRegistry;

class TermJournalRepository extends AbstractTermRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TermJournal::class);
    }

    protected function getType(): string
    {
        return 'journal';
    }

    public function findAllWithTranslations(): array
    {
        $qb = $this->createQueryBuilder('o');
        $qb
            ->addSelect('t', 'e', 'et')
            ->leftJoin('o.translation', 't')
            ->leftJoin('o.entries', 'e')
            ->leftJoin('e.translation', 'et')
            ->where('o INSTANCE OF :type')
            ->setParameter('type', $this->getType())
        ;

        return $qb->getQuery()->getResult();
    }
}
