<?php

declare(strict_types=1);

namespace App\Form\Term\TranslationsType;

use App\Form\SimpleTextCollectionType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ClassType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('customWeaponProf', SimpleTextCollectionType::class, [
                'required' => false,
                'label'    => 'Maniement des armes (spéciale)',
            ])
            ->add('customArmorProf', SimpleTextCollectionType::class, [
                'required' => false,
                'label'    => 'Maniement des armures (spéciale)',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefault('translation_domain', false);
    }
}
