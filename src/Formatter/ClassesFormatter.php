<?php

namespace App\Formatter;

use App\Entity\TermClass;
use App\Entity\TermInterface;
use App\Factory\TermClassFactory;
use App\Repository\TermClassRepository;

class ClassesFormatter implements TermFormatterInterface
{
    private const SUPPORTED_PACKS = ['classes'];

    private TermClassRepository $repository;

    /** @var TermClass[]|null */
    private static ?array $existing = null;

    public function __construct(TermClassRepository $repository)
    {
        $this->repository = $repository;
    }

    public function supports(string $pack): bool
    {
        return \in_array($pack, self::SUPPORTED_PACKS, true);
    }

    public function format(string $pack, array $dataset): TermInterface
    {
        $term = $this->getEntity($pack, $dataset);

        $term->setDescription($dataset['data']['description']['value'] ?? '');
        $term->setCustomWeaponProf($dataset['data']['weaponProf']['custom'] ?? '');

        return $term;
    }

    private function getEntity(string $pack, array $dataset): TermClass
    {
        $this->warmup();

        foreach (static::$existing as $existing) {
            if ($existing->getName() === $dataset['name']) {
                return $existing;
            }
        }

        $term = new TermClass();
        $term->setPack($pack);
        $term->setName($dataset['name']);

        return $term;
    }

    private function warmup(): void
    {
        if (null === static::$existing) {
            static::$existing = $this->repository->findAll();
        }
    }
}
