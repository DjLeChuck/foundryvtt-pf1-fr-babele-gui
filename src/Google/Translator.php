<?php

namespace App\Google;

use Psr\Log\LoggerInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class Translator
{
    private HttpClientInterface $googleScriptClient;
    private LoggerInterface $logger;

    public function __construct(HttpClientInterface $googleScriptClient, LoggerInterface $logger)
    {
        $this->googleScriptClient = $googleScriptClient;
        $this->logger = $logger;
    }

    public function translate(string $text): ?string
    {
        try {
            $response = $this->googleScriptClient->request('POST', '', [
                'body' => ['text' => $text],
            ]);

            $dataset = $response->toArray();

            if (!$dataset['success']) {
                throw new \RuntimeException($dataset['message']);
            }

            return $dataset['message'];
        } catch (\Throwable $e) {
            $this->logger->error('Erreur lors de la traduction de {term} : {error}', [
                'term'  => $text,
                'error' => $e->getMessage(),
            ]);

            return null;
        }
    }
}
