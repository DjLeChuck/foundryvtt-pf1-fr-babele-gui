<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\TermItem;
use Doctrine\Persistence\ManagerRegistry;

class TermItemRepository extends AbstractTermRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TermItem::class);
    }

    protected function getType(): string
    {
        return 'items';
    }
}
