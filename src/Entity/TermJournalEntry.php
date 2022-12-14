<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\TermJournalEntryRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TermJournalEntryRepository::class)]
#[ORM\Table(name: 'app_term_journal_entry')]
class TermJournalEntry extends Term
{
    #[ORM\ManyToOne(targetEntity: TermJournal::class, inversedBy: 'entries')]
    #[ORM\JoinColumn(name: 'journal_id', referencedColumnName: 'id')]
    private ?TermJournal $journal = null;

    public function getJournal(): ?TermJournal
    {
        return $this->journal;
    }

    public function setJournal(?TermJournal $journal): void
    {
        $this->journal = $journal;
    }
}
