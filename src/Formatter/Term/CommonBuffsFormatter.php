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

        $term->setDescription($dataset['data']['description']['value'] ?? '');

        $this->setContextNotes($term, $dataset);

        $flags = [];
        foreach ($dataset['data']['flags']['dictionary'] ?? [] as $value) {
            $flags[] = end($value);
        }
        $term->setDictionaryFlags($flags);

        return $term;
    }

    protected function getEntityClass(): string
    {
        return TermCommonBuff::class;
    }
}
