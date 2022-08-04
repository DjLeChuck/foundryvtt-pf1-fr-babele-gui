<?php

namespace App\OAuth2;

use HWI\Bundle\OAuthBundle\OAuth\ResourceOwner\GenericOAuth2ResourceOwner;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DiscordResourceOwner extends GenericOAuth2ResourceOwner
{
    public const TYPE = 'discord';

    protected array $paths = [
        'identifier' => 'id',
        'nickname'   => 'username',
        'email'      => 'email',
    ];

    protected function configureOptions(OptionsResolver $resolver): void
    {
        parent::configureOptions($resolver);

        $resolver->setDefaults([
            'authorization_url' => 'https://discord.com/api/oauth2/authorize',
            'access_token_url'  => 'https://discord.com/api/oauth2/token',
            'infos_url'         => 'https://discord.com/api/users/@me',
            'scope'             => 'identify email',
        ]);
    }
}
