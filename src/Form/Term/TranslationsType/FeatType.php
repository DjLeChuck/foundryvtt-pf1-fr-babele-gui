<?php

declare(strict_types=1);

namespace App\Form\Term\TranslationsType;

use App\Form\ActionsType;
use App\Form\SimpleTextareaCollectionType;
use App\Form\SimpleTextCollectionType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FeatType extends AbstractType
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
            ->add('customWeaponProf', SimpleTextCollectionType::class, [
                'required' => false,
                'label'    => 'Maniement des armes (spéciale)',
            ])
            ->add('tags', SimpleTextCollectionType::class, [
                'required' => false,
                'label'    => 'Étiquettes',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefault('translation_domain', false);
    }
}
