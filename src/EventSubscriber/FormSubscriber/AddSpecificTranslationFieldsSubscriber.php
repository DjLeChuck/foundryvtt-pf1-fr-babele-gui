<?php

declare(strict_types=1);

namespace App\EventSubscriber\FormSubscriber;

use App\Entity\TermTranslationClass;
use App\Form\Term\TranslationsType\ClassType;
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
        $formType = match ($event->getData()::class) {
            TermTranslationClass::class => ClassType::class,
            default => null,
        };

        if (null === $formType) {
            return;
        }

        $form = $event->getForm();

        /** @var FormInterface $specificForm */
        foreach ($this->formFactory->create($formType) as $specificForm) {
            $form->add(
                $specificForm->getName(),
                $specificForm->getConfig()->getType()->getInnerType()::class,
                $specificForm->getConfig()->getOptions()
            );
        }
    }
}
