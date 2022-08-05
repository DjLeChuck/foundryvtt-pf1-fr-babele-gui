<?php

namespace App\Command;

use App\Entity\Term;
use App\Entity\TermTranslation;
use App\Formatter\SpellDescriptionFormatter;
use App\Repository\TermRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:term:clean-spells',
    description: 'Nettoie la description des sorts pour retirer les éléments superflus déjà propulsés par le système',
)]
class TermCleanSpellsCommand extends Command
{
    private TermRepository $termRepository;
    private EntityManagerInterface $em;

    public function __construct(TermRepository $termRepository, EntityManagerInterface $em)
    {
        parent::__construct();

        $this->termRepository = $termRepository;
        $this->em = $em;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $io->title('Début du traitement');
        $io->progressStart();

        $formatter = new SpellDescriptionFormatter();

        /** @var Term $term */
        foreach ($io->progressIterate($this->termRepository->findSpellsWithDescription()) as $term) {
            /** @var TermTranslation $translation */
            $translation = $term->getTranslation();

            $translation->setDescription($formatter->format($translation->getDescription()));
        }

        $io->info('Enregistrement en BDD.');
        $this->em->flush();

        $io->success('Traitement terminé.');

        return Command::SUCCESS;
    }
}
