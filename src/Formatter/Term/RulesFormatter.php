<?php

namespace App\Formatter\Term;

use App\Entity\TermInterface;
use App\Entity\TermJournal;
use App\Entity\TermJournalEntry;
use App\Repository\TermJournalRepository;

class RulesFormatter extends AbstractFormatter
{
    public function __construct(TermJournalRepository $repository)
    {
        $this->repository = $repository;
    }

    public function supports(string $pack): bool
    {
        return 'pf1e-rules' === $pack;
    }

    public function format(string $pack, array $dataset): TermInterface
    {
        /** @var TermJournal $term */
        $term = $this->getEntity($pack, $dataset);

        $term->setName($dataset['name']);

        foreach ($dataset['pages'] as $pageDataset) {
            $page = $this->getJournalEntry($term, $pageDataset['_id']);

            $page->setName($pageDataset['name']);
            $page->setDescription($pageDataset['text']['content']);

            $term->addEntry($page);
        }

        return $term;
    }

    protected function getEntityClass(): string
    {
        return TermJournal::class;
    }

    private function getJournalEntry(TermJournal $journal, string $pageId): TermJournalEntry
    {
        foreach ($journal->getEntries() as $entry) {
            if ($pageId === $entry->getPackId()) {
                return $entry;
            }
        }

        $entry = new TermJournalEntry();
        $entry->setPackId($pageId);
        $entry->setPack('pf1e-rules');

        return $entry;
    }
}
