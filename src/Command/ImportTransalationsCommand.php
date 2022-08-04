<?php

namespace App\Command;

use App\Importer\TranslationImporter;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Finder\Finder;

#[AsCommand(
    name: 'app:import:transalations',
    description: 'Importe les fichiers de traduction des pack du système en BDD',
)]
class ImportTransalationsCommand extends Command
{
    private TranslationImporter $importer;

    public function __construct(TranslationImporter $importer)
    {
        parent::__construct();

        $this->importer = $importer;
    }

    protected function configure(): void
    {
        $this->addArgument('path', InputArgument::REQUIRED, 'Répertoire de stockage des traductions');
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

        foreach ($finder->in($path)->files()->sortByName()->name('*.json') as $file) {
            $io->info(sprintf('Import du fichier %s', $file->getFilename()));

            $this->importer->import($file, $io);
        }

        return Command::SUCCESS;
    }
}
