<?php

namespace App\Command;

use App\Importer\PackImporter;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Finder\Finder;

#[AsCommand(
    name: 'app:import-packs',
    description: 'Importe les fichiers pack du système en BDD',
)]
class ImportPacksCommand extends Command
{
    private PackImporter $packImporter;

    public function __construct(PackImporter $packImporter)
    {
        parent::__construct();

        $this->packImporter = $packImporter;
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

        $finder = new Finder();

        foreach ($finder->in($path)->files()->sortByName()->name('*.db') as $file) {
            $io->info(sprintf('Import du fichier %s', $file->getFilename()));

            $this->packImporter->import($file, $io);
        }

        return Command::SUCCESS;
    }
}
