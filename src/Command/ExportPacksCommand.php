<?php

namespace App\Command;

use App\Exporter\PackExporter;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Filesystem\Filesystem;

#[AsCommand(
    name: 'app:export:packs',
    description: 'Exporte les fichiers pack de la BDD au format attendu par le module',
)]
class ExportPacksCommand extends Command
{
    private PackExporter $exporter;

    public function __construct(PackExporter $exporter)
    {
        parent::__construct();

        $this->exporter = $exporter;
    }

    protected function configure(): void
    {
        $this->addArgument('path', InputArgument::REQUIRED, 'Répertoire de stockage des packs');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $path = $input->getArgument('path');
        $filesystem = new Filesystem();

        if (!$filesystem->exists($path)) {
            $io->error(sprintf('Le chemin %s n\'existe pas.', $path));

            return self::FAILURE;
        }

        $this->exporter->export($path, $io);

        $io->success('Traitement terminé !');

        return Command::SUCCESS;
    }
}
