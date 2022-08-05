<?php

namespace App\EventSubscriber;

use Gedmo\Blameable\BlameableListener;
use Gedmo\Loggable\LoggableListener;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Security\Core\Security;

class DoctrineExtensionSubscriber implements EventSubscriberInterface
{
    private BlameableListener $blameableListener;
    private LoggableListener $loggableListener;
    private Security $security;

    public function __construct(
        Security $security,
        BlameableListener $blameableListener,
        LoggableListener $loggableListener
    ) {
        $this->security = $security;
        $this->blameableListener = $blameableListener;
        $this->loggableListener = $loggableListener;
    }

    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::REQUEST => 'onKernelRequest',
        ];
    }

    public function onKernelRequest(): void
    {
        $user = $this->security->getUser();
        if (null !== $user) {
            $this->blameableListener->setUserValue($user);
            $this->loggableListener->setUsername($user->getUserIdentifier());
        }
    }
}
