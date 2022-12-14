<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'app_term_translation_journal_entry')]
class TermTranslationJournalEntry extends TermTranslation
{
    #[ORM\ManyToOne(targetEntity: TermTranslationJournal::class, inversedBy: 'entries')]
    #[ORM\JoinColumn(name: 'journal_id', referencedColumnName: 'id')]
    private ?TermTranslationJournal $journal = null;

    public function getJournal(): ?TermTranslationJournal
    {
        return $this->journal;
    }

    public function setJournal(?TermTranslationJournal $journal): void
    {
        $this->journal = $journal;
    }
}
