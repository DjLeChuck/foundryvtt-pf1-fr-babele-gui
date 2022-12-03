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

        $actions = [];
        foreach ($dataset['data']['actions'] ?? [] as $action) {
            $actions[] = [
                'name'        => $action['name'],
                'duration'    => 'spec' === ($action['duration']['units'] ?? '') ? $action['duration']['value'] ?? '' : '',
                'range'       => 'spec' === ($action['range']['units'] ?? '') ? $action['range']['value'] ?? '' : '',
                'save'        => $action['save']['description'],
                'spellEffect' => $action['spellEffect'],
                'spellArea'   => $action['spellArea'],
                'effectNotes' => $action['effectNotes'],
                'target'      => $action['target']['value'] ?? '',
            ];
        }
        $term->setActions($actions);

        $classes = [];
        foreach ($dataset['data']['associations']['classes'] ?? [] as $class) {
            $classes[] = current($class);
        }
        $term->setClasses($classes);

        $contextNotes = [];
        foreach ($dataset['data']['contextNotes'] ?? [] as $note) {
            $contextNotes[] = $note['text'];
        }
        $term->setContextNotes($contextNotes);

        $tags = [];
        foreach ($dataset['data']['tags'] ?? [] as $tag) {
            $tags[] = current($tag);
        }
        $term->setTags($tags);

        return $term;
    }

    protected function getEntityClass(): string
    {
        return TermClassAbility::class;
    }
}
