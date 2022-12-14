<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'app_term_translation_journal')]
class TermTranslationJournal extends TermTranslation
{
    #[ORM\OneToMany(mappedBy: 'journal', targetEntity: TermTranslationJournalEntry::class, cascade: ['all'], fetch: 'EAGER')]
    private Collection $entries;

    public function __construct()
    {
        $this->entries = new ArrayCollection();
    }

    /**
     * @return Collection<TermTranslationJournalEntry>
     */
    public function getEntries(): Collection
    {
        return $this->entries;
    }

    public function addEntry(TermTranslationJournalEntry $entry): void
    {
        if (!$this->entries->contains($entry)) {
            $this->entries[] = $entry;
            $entry->setJournal($this);
        }
    }

    public function removeProduct(TermTranslationJournalEntry $entry): void
    {
        if ($this->entries->contains($entry)) {
            $this->entries->removeElement($entry);
            if ($entry->getJournal() === $this) {
                $entry->setJournal(null);
            }
        }
    }
}
