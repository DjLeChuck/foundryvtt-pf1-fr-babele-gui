<?php

declare(strict_types=1);

namespace App\Form\Term\TranslationsType;

use App\Form\ActionsType;
use App\Form\SimpleTextareaCollectionType;
use App\Form\SimpleTextCollectionType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ClassAbilityType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('actions', ActionsType::class, [
                'required' => false,
                'label'    => 'Actions',
            ])
            ->add('contextNotes', SimpleTextareaCollectionType::class, [
                'required' => false,
                'label'    => 'Notes de contexte',
            ])
            ->add('tags', SimpleTextCollectionType::class, [
                'required' => false,
                'label'    => 'Étiquettes',
            ])
            ->add('classes', SimpleTextCollectionType::class, [
                'required' => false,
                'label'    => 'Classes',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefault('translation_domain', false);
    }
}
