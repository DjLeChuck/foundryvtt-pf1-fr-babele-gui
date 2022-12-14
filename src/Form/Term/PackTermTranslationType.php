<?php

declare(strict_types=1);

namespace App\Form\Term;

use App\Entity\TermTranslationInterface;
use App\EventSubscriber\FormSubscriber\AddSpecificTranslationFieldsSubscriber;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PackTermTranslationType extends AbstractType
{
    private AddSpecificTranslationFieldsSubscriber $addFieldsSubscriber;

    public function __construct(AddSpecificTranslationFieldsSubscriber $addFieldsSubscriber)
    {
        $this->addFieldsSubscriber = $addFieldsSubscriber;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('id', HiddenType::class)
            ->add('name', TextType::class, [
                'required' => false,
                'label'    => false,
            ])
            ->add('description', TextareaType::class, [
                'required' => false,
                'label'    => 'Description',
            ])
            ->addEventSubscriber($this->addFieldsSubscriber)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'translation_domain' => false,
            'data_class'         => TermTranslationInterface::class,
        ]);
    }
}
