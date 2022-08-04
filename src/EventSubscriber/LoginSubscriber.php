<?php

namespace App\EventSubscriber;

use App\Security\DiscordGuildAccess;
use HWI\Bundle\OAuthBundle\Security\Core\Authentication\Token\OAuthToken;
use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Security\Core\Event\AuthenticationSuccessEvent;
use Symfony\Component\Security\Core\Exception\AuthenticationException;

class LoginSubscriber implements EventSubscriberInterface
{
    private DiscordGuildAccess $guildAccess;
    private LoggerInterface $logger;

    public function __construct(DiscordGuildAccess $guildAccess, LoggerInterface $logger)
    {
        $this->guildAccess = $guildAccess;
        $this->logger = $logger;
    }

    public static function getSubscribedEvents(): array
    {
        return [
            AuthenticationSuccessEvent::class => 'checkGuildAccess',
        ];
    }

    public function checkGuildAccess(AuthenticationSuccessEvent $event): void
    {
        /** @var OAuthToken $token */
        $token = $event->getAuthenticationToken();

        if (!$this->guildAccess->hasAccess($token->getAccessToken())) {
            $this->logger->error('Validation d\'accès au serveur échouée pour {user}', [
                'user' => $token->getUserIdentifier(),
            ]);

            throw new AuthenticationException('Accès au serveur invalide.');
        }
    }
}
