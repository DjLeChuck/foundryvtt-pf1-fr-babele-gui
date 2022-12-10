<?php

declare(strict_types=1);

namespace App\Form\Term\TranslationsType;

use App\DTO\BestiaryImages;
use App\Form\DatalistType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BestiaryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('img', DatalistType::class, [
                'required' => false,
                'label'    => 'Image',
                'choices'  => BestiaryImages::getChoices(),
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefault('translation_domain', false);
    }
}
