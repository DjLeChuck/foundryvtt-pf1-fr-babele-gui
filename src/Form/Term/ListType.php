<?php

declare(strict_types=1);

namespace App\Form\Term;

use App\EventSubscriber\FormSubscriber\SetTermsSubscriber;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class ListType extends AbstractType
{
    private UrlGeneratorInterface $urlGenerator;
    private SetTermsSubscriber $termsSubscriber;

    public function __construct(UrlGeneratorInterface $urlGenerator, SetTermsSubscriber $termsSubscriber)
    {
        $this->urlGenerator = $urlGenerator;
        $this->termsSubscriber = $termsSubscriber;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('terms', CollectionType::class, [
                'entry_type' => PackTermType::class,
            ])
            ->addEventSubscriber($this->termsSubscriber)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefault('action', $this->urlGenerator->generate('app_translate_pack_process'));
    }
}
