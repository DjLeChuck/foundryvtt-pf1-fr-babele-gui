<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\TermJournalRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TermJournalRepository::class)]
#[ORM\Table(name: 'app_term_journal')]
class TermJournal extends Term
{
    #[ORM\OneToMany(mappedBy: 'journal', targetEntity: TermJournalEntry::class, cascade: ['all'], fetch: 'EAGER')]
    private Collection $entries;

    public function __construct()
    {
        $this->entries = new ArrayCollection();
    }

    /**
     * @return Collection<TermJournalEntry>
     */
    public function getEntries(): Collection
    {
        return $this->entries;
    }

    public function addEntry(TermJournalEntry $entry): void
    {
        if (!$this->entries->contains($entry)) {
            $this->entries[] = $entry;
            $entry->setJournal($this);
        }
    }

    public function removeEntry(TermJournalEntry $entry): void
    {
        if ($this->entries->contains($entry)) {
            $this->entries->removeElement($entry);
            if ($entry->getJournal() === $this) {
                $entry->setJournal(null);
            }
        }
    }

    public function getCompendiumLinkTag(): string
    {
        return sprintf('@UUID[Compendium.pf1.pf1e-rules.%s]{__label__}', $this->getPackId());
    }
}
