<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\TermBestiary;
use Doctrine\Persistence\ManagerRegistry;

class TermBestiaryRepository extends AbstractTermRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TermBestiary::class);
    }

    protected function getType(): string
    {
        return 'bestiary';
    }
}
