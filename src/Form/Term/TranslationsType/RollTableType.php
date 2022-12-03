<?php

declare(strict_types=1);

namespace App\Form\Term\TranslationsType;

use App\Form\SimpleTextareaCollectionType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RollTableType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('simple_description', TextareaType::class, [
                'required'      => false,
                'label'         => 'Description',
                'property_path' => 'description',
            ])
            ->add('results', SimpleTextareaCollectionType::class, [
                'required' => false,
                'label'    => 'Résultats',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefault('translation_domain', false);
    }
}
