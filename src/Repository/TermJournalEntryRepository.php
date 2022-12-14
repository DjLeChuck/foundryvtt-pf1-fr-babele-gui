<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\TermJournalEntry;
use Doctrine\Persistence\ManagerRegistry;

class TermJournalEntryRepository extends AbstractTermRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TermJournalEntry::class);
    }

    protected function getType(): string
    {
        return 'journal-entry';
    }
}
