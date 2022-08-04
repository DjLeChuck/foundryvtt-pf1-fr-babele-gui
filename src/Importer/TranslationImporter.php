<?php

namespace App\Importer;

use App\Entity\Term;
use App\Manager\TranslationManager;
use App\Repository\TermRepository;
use Symfony\Component\Console\Style\SymfonyStyle;

class TranslationImporter
{
    private TermRepository $termRepository;
    private TranslationManager $translationManager;
    private array $existings = [];

    public function __construct(TermRepository $termRepository, TranslationManager $translationManager)
    {
        $this->termRepository = $termRepository;
        $this->translationManager = $translationManager;
    }

    public function import(\SplFileInfo $file, SymfonyStyle $io): void
    {
        $content = file_get_contents($file->getPathname());
        if (false === $content) {
            throw new \RuntimeException(sprintf('Impossible de lire le fichier %s', $file->getPathname()));
        }

        try {
            $dataset = json_decode($content, true, 512, JSON_THROW_ON_ERROR);
        } catch (\Throwable $e) {
            $io->error(sprintf('Impossible de décoder le fichier %s', $file->getPathname()));

            return;
        }

        $pack = $this->getPackName($file);
        $this->existings = $this->termRepository->findPartialWithTranslationByPack($pack);

        foreach ($dataset['entries'] as $name => $data) {
            $term = $this->getTerm($name);
            if (null === $term) {
                $io->error(sprintf('Aucun terme en BDD pour le nom %s du pack %s', $name, $pack));

                continue;
            }

            $this->translationManager->updateTranslation($term, $data);
        }

        $this->translationManager->flush();
    }

    private function getPackName(\SplFileInfo $file): string
    {
        return str_replace(
            ['pf1.', 'mythicpaths', 'racialhd'],
            ['', 'mythic-paths', 'racial-hd'],
            $file->getBasename('.json')
        );
    }

    private function getTerm(string $name): ?Term
    {
        /** @var Term $existing */
        foreach ($this->existings as $existing) {
            if ($existing->getName() === $name) {
                return $existing;
            }
        }

        return null;
    }
}
