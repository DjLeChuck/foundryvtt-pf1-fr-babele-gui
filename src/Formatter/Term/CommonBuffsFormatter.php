<?php

namespace App\Formatter\Term;

use App\Entity\TermCommonBuff;
use App\Entity\TermInterface;
use App\Repository\TermCommonBuffRepository;

class CommonBuffsFormatter extends AbstractFormatter
{
    public function __construct(TermCommonBuffRepository $repository)
    {
        $this->repository = $repository;
    }

    public function supports(string $pack): bool
    {
        return 'commonbuffs' === $pack;
    }

    public function format(string $pack, array $dataset): TermInterface
    {
        /** @var TermCommonBuff $term */
        $term = $this->getEntity($pack, $dataset);

        $contextNotes = [];
        $flags = [];

        foreach ($dataset['data']['contextNotes'] ?? [] as $note) {
            $contextNotes[] = $note['text'];
        }

        foreach ($dataset['data']['flags']['dictionary'] ?? [] as $value) {
            $flags[] = end($value);
        }

        $term->setDescription($dataset['data']['description']['value'] ?? '');
        $term->setDictionaryFlags(!empty($flags) ? $flags : null);
        $term->setContextNotes(!empty($contextNotes) ? $contextNotes : null);

        return $term;
    }

    protected function getEntityClass(): string
    {
        return TermCommonBuff::class;
    }
}
