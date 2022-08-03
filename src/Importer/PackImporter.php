<?php

namespace App\Importer;

use App\Entity\Term;
use App\Formatter\TermDataFormatter;
use App\Repository\TermRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class PackImporter
{
    private TermRepository $termRepository;
    private EntityManagerInterface $em;
    private TermDataFormatter $termDataFormatter;
    private array $existings = [];

    public function __construct(
        TermRepository $termRepository,
        EntityManagerInterface $em,
        TermDataFormatter $termDataFormatter
    ) {
        $this->termRepository = $termRepository;
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
        $this->existings = $this->termRepository->findPartialByPack($pack);

        foreach (explode("\n", $content) as $key => $row) {
            if (empty($row)) {
                continue;
            }

            try {
                $termDto = $this->termDataFormatter->format(
                    $pack,
                    json_decode($row, true, 512, JSON_THROW_ON_ERROR)
                );
                $term = $this->getTerm($pack, $termDto->name);
                $term->setDescription($termDto->description);
            } catch (\Throwable $e) {
                $io->error(sprintf('Impossible de traiter la ligne %u : %s', $key + 1, $e->getMessage()));
            }
        }

        $this->em->flush();
    }

    private function getTerm(string $pack, string $name): Term
    {
        /** @var Term $existing */
        foreach ($this->existings as $existing) {
            if ($existing->getName() === $name) {
                return $existing;
            }
        }

        $term = new Term();
        $term->setName($name);
        $term->setPack($pack);
        $this->termRepository->add($term);

        return $term;
    }
}
