<?php

declare(strict_types=1);

namespace App\Form\Term\TranslationsType;

use App\Form\SimpleTextareaCollectionType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MonsterTemplateType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
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
