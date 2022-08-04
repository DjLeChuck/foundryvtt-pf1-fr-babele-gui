<?php

namespace App\DTO;

use HWI\Bundle\OAuthBundle\OAuth\Response\UserResponseInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class User implements UserInterface
{
    private string $email;
    private string $nickname;

    public function __construct(UserResponseInterface $response)
    {
        $this->email = $response->getEmail();
        $this->nickname = $response->getNickname();
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getNickname(): string
    {
        return $this->nickname;
    }

    public function getRoles(): array
    {
        return ['ROLE_USER', 'ROLE_OAUTH_USER'];
    }

    public function eraseCredentials(): bool
    {
        return true;
    }

    public function getUserIdentifier(): string
    {
        return $this->email;
    }
}
