<?php

declare(strict_types=1);

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class DictionaryFlagsEntryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('key', HiddenType::class)
            ->add('value', TextType::class, ['label' => false])
        ;

        $builder->addModelTransformer(
            new CallbackTransformer(
                static function ($value) {
                    if (null === $value) {
                        return null;
                    }

                    return [
                        'key'   => array_shift($value),
                        'value' => array_shift($value),
                    ];
                },
                static function ($value) {
                    return [$value['key'], $value['value']];
                }
            )
        );
    }
}
