<?php

namespace App\Formatter\Term;

use App\Entity\TermArmorAndShield;
use App\Entity\TermInterface;
use App\Repository\TermArmorAndShieldRepository;

class ArmorsAndShieldsFormatter extends AbstractFormatter
{
    public function __construct(TermArmorAndShieldRepository $repository)
    {
        $this->repository = $repository;
    }

    public function supports(string $pack): bool
    {
        return 'armors-and-shields' === $pack;
    }

    public function format(string $pack, array $dataset): TermInterface
    {
        /** @var TermArmorAndShield $term */
        $term = $this->getEntity($pack, $dataset);

        $term->setDescription($dataset['data']['description']['value'] ?? '');

        return $term;
    }

    protected function getEntityClass(): string
    {
        return TermArmorAndShield::class;
    }
}
