<?php

namespace App\Security;

use App\DTO\User;
use HWI\Bundle\OAuthBundle\OAuth\Response\UserResponseInterface;
use HWI\Bundle\OAuthBundle\Security\Core\User\OAuthAwareUserProviderInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

class DiscordOAuthUserProvider implements UserProviderInterface, OAuthAwareUserProviderInterface
{
    private RequestStack $requestStack;

    public function __construct(RequestStack $requestStack)
    {
        $this->requestStack = $requestStack;
    }

    public function loadUserByIdentifier(string $identifier): UserInterface
    {
        return $this->getSession()->get('user_data');
    }

    public function loadUserByOAuthUserResponse(UserResponseInterface $response): UserInterface
    {
        $user = new User($response);

        $session = $this->getSession();
        $session->set('user_data', $user);
        $session->save();

        return $user;
    }

    public function refreshUser(UserInterface $user): UserInterface
    {
        if (!$this->supportsClass(\get_class($user))) {
            throw new UnsupportedUserException(sprintf('Unsupported user class "%s"', \get_class($user)));
        }

        return $this->loadUserByIdentifier($user->getUserIdentifier());
    }

    public function supportsClass($class): bool
    {
        return User::class === $class;
    }

    private function getSession(): SessionInterface
    {
        $request = $this->requestStack->getMainRequest();
        if (null === $request) {
            throw new \RuntimeException('Cannot determine current request.');
        }

        return $request->getSession();
    }
}
