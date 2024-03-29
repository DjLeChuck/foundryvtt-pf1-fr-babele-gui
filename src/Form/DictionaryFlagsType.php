<?php

declare(strict_types=1);

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DictionaryFlagsType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'entry_type'    => DictionaryFlagsEntryType::class,
            'entry_options' => ['label' => false],
        ]);
    }

    public function getParent(): string
    {
        return CollectionType::class;
    }
}
