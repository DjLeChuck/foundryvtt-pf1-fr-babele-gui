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
    name: 'app:match-bestiary',
    description: 'Crée les traductions des bestiaires connus',
)]
class MatchBestiaryCommand extends Command
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

        foreach ($this->termRepository->fetchMatchingBestiary() as $row) {
            $term = $this->termRepository->find($row['term_id']);
            if (null === $term) {
                $io->error(sprintf('Terme #%u introuvable', $row['term_id']));

                continue;
            }

            $translation = new TermTranslation();
            $translation->setName($row['name_fr']);
            $translation->setDescription('');
            $translation->setTerm($term);

            $term->setTranslation($translation);
        }

        $this->em->flush();

        $io->success('You have a new command! Now make it your own! Pass --help to see your options.');

        return Command::SUCCESS;
    }
}
