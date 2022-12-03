<?php

namespace App\Formatter\Term;

use App\Entity\TermInterface;
use App\Entity\TermWeaponAndAmmo;
use App\Repository\TermWeaponAndAmmoRepository;

class WeaponAndAmmoFormatter extends AbstractFormatter
{
    public function __construct(TermWeaponAndAmmoRepository $repository)
    {
        $this->repository = $repository;
    }

    public function supports(string $pack): bool
    {
        return 'weapons-and-ammo' === $pack;
    }

    public function format(string $pack, array $dataset): TermInterface
    {
        /** @var TermWeaponAndAmmo $term */
        $term = $this->getEntity($pack, $dataset);

        $term->setDescription($dataset['data']['description']['value'] ?? '');
        $this->setContextNotes($term, $dataset);

        return $term;
    }

    protected function getEntityClass(): string
    {
        return TermWeaponAndAmmo::class;
    }
}
