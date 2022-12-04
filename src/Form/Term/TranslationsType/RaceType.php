<?php

declare(strict_types=1);

namespace App\Form\Term\TranslationsType;

use App\Form\SimpleTextareaCollectionType;
use App\Form\SimpleTextCollectionType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RaceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('customLanguages', SimpleTextCollectionType::class, [
                'required' => false,
                'label'    => 'Langues (spéciale)',
            ])
            ->add('subTypes', SimpleTextCollectionType::class, [
                'required' => false,
                'label'    => 'Sous-types',
            ])
            ->add('contextNotes', SimpleTextareaCollectionType::class, [
                'required' => false,
                'label'    => 'Notes de contexte',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefault('translation_domain', false);
    }
}
