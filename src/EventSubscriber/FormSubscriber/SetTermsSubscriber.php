<?php

declare(strict_types=1);

namespace App\EventSubscriber\FormSubscriber;

use App\Repository\TermRepository;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\Event\PreSubmitEvent;
use Symfony\Component\Form\FormEvents;

class SetTermsSubscriber implements EventSubscriberInterface
{
    private TermRepository $termRepository;

    public function __construct(TermRepository $termRepository)
    {
        $this->termRepository = $termRepository;
    }

    public static function getSubscribedEvents(): array
    {
        return [
            FormEvents::PRE_SUBMIT => 'onPreSubmit',
        ];
    }

    public function onPreSubmit(PreSubmitEvent $event): void
    {
        $ids = array_filter(array_map(static fn($term) => $term['id'], $event->getData()['terms'] ?? []));
        $terms = $this->termRepository->findMultipleWithTranslation($ids);
        $newData = [];

        foreach ($event->getData()['terms'] as $key => $submittedTerm) {
            foreach ($terms as $term) {
                if ($term->getId() !== (int) $submittedTerm['id']) {
                    continue;
                }

                $newData[$key] = $term;
            }
        }

        $event->getForm()->setData(['terms' => $newData]);
    }
}
