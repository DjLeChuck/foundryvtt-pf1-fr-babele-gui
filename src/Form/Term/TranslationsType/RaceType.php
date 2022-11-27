<?php

declare(strict_types=1);

namespace App\Form\Term\TranslationsType;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RaceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('subTypes', TextareaType::class, [
                'required' => false,
                'label'    => 'Sous-types',
            ])
            ->add('contextNotes', TextareaType::class, [
                'required' => false,
                'label'    => 'Notes de contexte',
            ])
        ;

        $callback = new CallbackTransformer(
            static function ($value) {
                if (null === $value) {
                    return null;
                }

                return implode(';', $value);
            },
            static function ($value) {
                if (null === $value) {
                    return null;
                }

                return explode(';', $value);
            }
        );

        $builder->get('subTypes')->addModelTransformer($callback);

        $builder->get('contextNotes')->addModelTransformer($callback);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefault('translation_domain', false);
    }
}
