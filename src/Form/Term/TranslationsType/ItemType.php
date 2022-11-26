<?php

declare(strict_types=1);

namespace App\Form\Term\TranslationsType;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ItemType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('unidentifiedName', TextType::class, [
                'required' => false,
                'label'    => 'Nom (non identifié)',
            ])
            ->add('unidentifiedDescription', TextareaType::class, [
                'required' => false,
                'label'    => 'Description (non identifié)',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefault('translation_domain', false);
    }
}