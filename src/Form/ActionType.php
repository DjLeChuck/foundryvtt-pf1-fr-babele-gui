<?php

declare(strict_types=1);

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ActionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'required' => false,
                'label'    => 'Nom',
            ])
            ->add('save', TextType::class, [
                'required' => false,
                'label'    => 'Effet du jet de sauvegarde',
            ])
            ->add('spellEffect', TextType::class, [
                'required' => false,
                'label'    => 'Effet du sort',
            ])
            ->add('target', TextType::class, [
                'required' => false,
                'label'    => 'Cible',
            ])
            ->add('spellArea', TextType::class, [
                'required' => false,
                'label'    => 'Zone d\'effet',
            ])
            ->add('duration', TextType::class, [
                'required' => false,
                'label'    => 'Durée',
            ])
            ->add('effectNotes', SimpleTextCollectionType::class, [
                'required' => false,
                'label'    => 'Notes sur les effets',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefault('translation_domain', false);
    }
}
