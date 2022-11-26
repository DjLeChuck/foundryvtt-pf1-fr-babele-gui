<?php

namespace App\Importer;

use App\Formatter\TermDataFormatter;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class PackImporter
{
    private EntityManagerInterface $em;
    private TermDataFormatter $termDataFormatter;

    public function __construct(EntityManagerInterface $em, TermDataFormatter $termDataFormatter)
    {
        $this->em = $em;
        $this->termDataFormatter = $termDataFormatter;
    }

    public function import(\SplFileInfo $file, SymfonyStyle $io): void
    {
        $content = file_get_contents($file->getPathname());
        if (false === $content) {
            throw new \RuntimeException(sprintf('Impossible de lire le fichier %s', $file->getPathname()));
        }

        $pack = $file->getBasename('.db');

        foreach (explode("\n", $content) as $key => $row) {
            if (empty($row)) {
                continue;
            }

            try {
                $term = $this->termDataFormatter->format(
                    $pack,
                    json_decode($row, true, 512, JSON_THROW_ON_ERROR)
                );

                $this->em->persist($term);
            } catch (\Throwable $e) {
                $io->error(sprintf('Impossible de traiter la ligne %u : %s', $key + 1, $e->getMessage()));
            }
        }

        $this->em->flush();
    }
}
