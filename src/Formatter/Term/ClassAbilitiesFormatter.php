<?php

namespace App\Formatter\Term;

use App\Entity\TermClassAbility;
use App\Entity\TermInterface;
use App\Repository\TermClassAbilityRepository;

class ClassAbilitiesFormatter extends AbstractFormatter
{
    public function __construct(TermClassAbilityRepository $repository)
    {
        $this->repository = $repository;
    }

    public function supports(string $pack): bool
    {
        return 'class-abilities' === $pack;
    }

    public function format(string $pack, array $dataset): TermInterface
    {
        /** @var TermClassAbility $term */
        $term = $this->getEntity($pack, $dataset);

        $term->setDescription($dataset['data']['description']['value'] ?? '');

        $this->setActions($term, $dataset);
        $this->setContextNotes($term, $dataset);
        $this->setTags($term, $dataset);

        $classes = [];
        foreach ($dataset['data']['associations']['classes'] ?? [] as $class) {
            $classes[] = current($class);
        }
        $term->setClasses($classes);

        return $term;
    }

    protected function getEntityClass(): string
    {
        return TermClassAbility::class;
    }
}
