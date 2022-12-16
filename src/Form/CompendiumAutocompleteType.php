<?php

declare(strict_types=1);

namespace App\Form;

use App\Entity\Term;
use Doctrine\ORM\QueryBuilder;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Security;
use Symfony\UX\Autocomplete\Form\AsEntityAutocompleteField;
use Symfony\UX\Autocomplete\Form\ParentEntityAutocompleteType;

#[AsEntityAutocompleteField]
class CompendiumAutocompleteType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'attr'                  => [
                'data-controller'          => 'compendium-autocomplete',
                'data-action'              => 'search-modal:result@window->compendium-autocomplete#clearSelection',
                'data-search-modal-target' => 'term',
            ],
            'class'                 => Term::class,
            'label'                 => 'Terme recherché',
            'choice_label'          => static function (Term $term) {
                $translation = $term->getTranslation();

                return sprintf(
                    '%s<br /> <small class="text-muted">(%s - %s)</small>',
                    $translation?->getName(),
                    $term->getName(),
                    $term->getPack()
                );
            },
            'preload'               => false,
            'no_results_found_text' => 'Aucun résultat !',
            'no_more_results_text'  => 'Plus de résultat.',
            'security'              => function (Security $security): bool {
                return $security->isGranted('ROLE_USER');
            },
            'filter_query'          => function (QueryBuilder $qb, string $query) {
                if (!$query) {
                    return;
                }

                $qb
                    ->addSelect('t')
                    ->innerJoin('entity.translation', 't')
                    ->where('LOWER(entity.name) LIKE :likeTerm')
                    ->orWhere('LOWER(t.name) LIKE :likeTerm')
                    ->orWhere('entity.packId = :term')
                    ->orderBy('t.name')
                    ->addOrderBy('entity.name')
                    ->setParameter('term', mb_strtolower($query))
                    ->setParameter('likeTerm', '%'.mb_strtolower($query).'%')
                ;
            },
        ]);
    }

    public function getParent(): string
    {
        return ParentEntityAutocompleteType::class;
    }
}
