<?php

namespace App\Security;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class DiscordGuildAccess
{
    private HttpClientInterface $client;
    private string $guildId;

    public function __construct(HttpClientInterface $client, string $guildId)
    {
        $this->client = $client;
        $this->guildId = $guildId;
    }

    public function hasAccess(string $token): bool
    {
        try {
            $response = $this->client->request('GET', sprintf('https://discord.com/api/users/@me/guilds/%s/member', $this->guildId), [
                'headers' => [
                    'Content-Type'  => 'application/x-www-form-urlencoded',
                    'Authorization' => sprintf('Bearer %s', $token),
                ],
            ]);

            $dataset = $response->toArray();

            return $dataset['joined_at'] < new \DateTimeImmutable() && !$dataset['pending'];
        } catch (\Throwable) {
            return false;
        }
    }
}
