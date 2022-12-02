<?php

declare(strict_types=1);

namespace App\Form\Term\TranslationsType;

use App\Form\ActionsType;
use App\Form\SimpleTextCollectionType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SpellType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('actions', ActionsType::class, [
                'required' => false,
                'label'    => 'Actions',
            ])
            ->add('learnedAtClasses', SimpleTextCollectionType::class, [
                'required' => false,
                'label'    => 'Appris - NLS',
            ])
            ->add('learnedAtDomains', SimpleTextCollectionType::class, [
                'required' => false,
                'label'    => 'Appris - Domaine',
            ])
            ->add('learnedAtSubDomains', SimpleTextCollectionType::class, [
                'required' => false,
                'label'    => 'Appris - Sous-domaine',
            ])
            ->add('learnedAtBloodlines', SimpleTextCollectionType::class, [
                'required' => false,
                'label'    => 'Appris - Lignée',
            ])
            ->add('materials', TextType::class, [
                'required' => false,
                'label'    => 'Composantes matérielles',
            ])
            ->add('subschool', TextType::class, [
                'required' => false,
                'label'    => 'Branche',
            ])
            ->add('types', TextType::class, [
                'required' => false,
                'label'    => 'Types',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefault('translation_domain', false);
    }
}
