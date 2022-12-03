<?php

declare(strict_types=1);

namespace App\EventSubscriber\FormSubscriber;

use App\Entity\TermTranslation;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\Event\PreSetDataEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\FormInterface;

class AddSpecificTranslationFieldsSubscriber implements EventSubscriberInterface
{
    private FormFactoryInterface $formFactory;

    public function __construct(FormFactoryInterface $formFactory)
    {
        $this->formFactory = $formFactory;
    }

    public static function getSubscribedEvents(): array
    {
        return [
            FormEvents::PRE_SET_DATA => 'onPreSetData',
        ];
    }

    public function onPreSetData(PreSetDataEvent $event): void
    {
        $entityClass = $event->getData()::class;
        $formType = sprintf(
            'App\Form\Term\TranslationsType\%sType',
            str_replace(TermTranslation::class, '', $entityClass)
        );

        if (!class_exists($formType)) {
            throw new \InvalidArgumentException(
                sprintf('Le FormType %s spécifique à %s n\'existe pas', $formType, $entityClass)
            );
        }

        $form = $event->getForm();
        $builder = $this->formFactory->createBuilder();

        /** @var FormInterface $specificForm */
        foreach ($this->formFactory->create($formType) as $specificForm) {
            $modelTransformers = $specificForm->getConfig()->getModelTransformers();

            $field = $builder->create(
                $specificForm->getName(),
                $specificForm->getConfig()->getType()->getInnerType()::class,
                array_merge($specificForm->getConfig()->getOptions(), ['auto_initialize' => false])
            );

            foreach ($modelTransformers as $transformer) {
                $field->addModelTransformer($transformer);
            }

            $form->add($field->getForm());

            if ('simple_description' === $specificForm->getName()) {
                $form->remove('description');
            }
        }
    }
}
