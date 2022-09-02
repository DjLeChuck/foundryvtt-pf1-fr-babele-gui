<?php

namespace App\Command;

use App\Entity\TermTranslation;
use App\Repository\TermRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:term:add-missing-translations',
    description: 'Créer les traductions de termes manquante en y copiant l\'anglais',
)]
class TermAddMissingTranslationsCommand extends Command
{
    private TermRepository $termRepository;
    private EntityManagerInterface $entityManager;

    public function __construct(TermRepository $termRepository, EntityManagerInterface $entityManager)
    {
        parent::__construct();

        $this->termRepository = $termRepository;
        $this->entityManager = $entityManager;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $io->info('Création des traductions manquantes...');
        $io->progressStart();

        foreach ($this->termRepository->findWithoutTranslation() as $term) {
            $translation = new TermTranslation();
            $translation->setName($term->getName());
            $translation->setDescription($term->getDescription());
            $translation->setTerm($term);

            $term->setTranslation($translation);

            $io->progressAdvance();
        }

        $io->progressFinish();
        $io->info('Enregistrement en BDD...');
        $this->entityManager->flush();

        $io->success('Création des traductions manquantes terminée.');

        return Command::SUCCESS;
    }
}
