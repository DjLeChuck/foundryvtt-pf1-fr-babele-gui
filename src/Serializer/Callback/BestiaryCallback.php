<?php

declare(strict_types=1);

namespace App\Serializer\Callback;

use App\DTO\BestiaryImages;
use App\Entity\TermBestiary;
use App\Entity\TermTranslationBestiary;

class BestiaryCallback implements CallbackInterface
{
    private const TYPE_PORTRAIT = 'portraits';
    private const TYPE_TOKEN = 'tokens';

    public function supports(string $pack): bool
    {
        return str_starts_with($pack, 'bestiary-');
    }

    /**
     * @param TermBestiary[] $terms
     *
     * @return array
     */
    public function process(iterable $terms): array
    {
        $entries = [];

        foreach ($terms as $term) {
            $name = $term->getName();

            /** @var TermTranslationBestiary $translation */
            $translation = $term->getTranslation();
            $entries[$name] = array_filter([
                'name'        => $translation->getName() ?? $name,
                'description' => $translation->getDescription() ?? $term->getDescription(),
                'img'         => $this->getWebpPath(self::TYPE_PORTRAIT, $translation->getImg()) ?? $term->getImg(),
                'token'       => $this->getWebpPath(self::TYPE_TOKEN, $translation->getImg()) ?? $term->getImg(),
            ]);
        }

        return $entries;
    }

    private function getWebpPath(string $type, ?string $name): ?string
    {
        if (null === $name) {
            return null;
        }

        return str_replace('__type__', $type, BestiaryImages::getPath($name));
    }
}
