<?php

namespace App\Formatter\Term;

use App\Entity\TermClass;
use App\Entity\TermInterface;
use App\Repository\TermClassRepository;

class ClassesFormatter extends AbstractFormatter
{
    public function __construct(TermClassRepository $repository)
    {
        $this->repository = $repository;
    }

    public function supports(string $pack): bool
    {
        return 'classes' === $pack;
    }

    public function format(string $pack, array $dataset): TermInterface
    {
        /** @var TermClass $term */
        $term = $this->getEntity($pack, $dataset);

        $term->setDescription($dataset['data']['description']['value'] ?? '');
        $term->setCustomWeaponProf(array_filter(explode(';', $dataset['data']['weaponProf']['custom'] ?? '')));
        $term->setCustomArmorProf(array_filter(explode(';', $dataset['data']['armorProf']['custom'] ?? '')));

        return $term;
    }

    protected function getEntityClass(): string
    {
        return TermClass::class;
    }
}
