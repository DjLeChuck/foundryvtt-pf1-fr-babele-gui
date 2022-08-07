<?php

namespace App\Command;

use App\Repository\TermRepository;
use League\HTMLToMarkdown\Converter\TableConverter;
use League\HTMLToMarkdown\HtmlConverter;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Filesystem\Filesystem;
use Twig\Environment;

#[AsCommand(
    name: 'app:module:update',
    description: 'Met à jour les fichiers de traduction dans le module ainsi que les statistiques des traductions',
)]
class ModuleUpdateCommand extends Command
{
    private Environment $twig;
    private TermRepository $termRepository;

    public function __construct(Environment $twig, TermRepository $termRepository)
    {
        parent::__construct();

        $this->twig = $twig;
        $this->termRepository = $termRepository;
    }

    protected function configure(): void
    {
        $this->addArgument('path', InputArgument::REQUIRED, 'Répertoire du module');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $path = rtrim($input->getArgument('path'), '/');
        $filesystem = new Filesystem();

        if (!$filesystem->exists($path)) {
            $io->error(sprintf('Le chemin %s n\'existe pas.', $path));

            return self::FAILURE;
        }

        $packExportPath = sprintf('%s/compendium/fr', $path);
        if (!$filesystem->exists($packExportPath)) {
            $io->error('Répertoire des traductions inexistant.');

            return self::FAILURE;
        }

        // Export de tous les packs
        $command = $this->getApplication()?->find('app:export:packs');
        if (null === $command) {
            $io->error('Commande d\'export des packs introuvable.');

            return self::FAILURE;
        }

        $greetInput = new ArrayInput(['path' => $packExportPath]);

        try {
            $returnCode = $command->run($greetInput, $output);

            if (self::SUCCESS !== $returnCode) {
                throw new \RuntimeException(sprintf('Code de sortie en erreur (%u)', $returnCode));
            }
        } catch (\Throwable $e) {
            $io->error(sprintf('Erreur lors de l\'export des packs : %s', $e->getMessage()));

            return self::FAILURE;
        }

        $io->info('Mise à jour des stats de traduction dans le README.md');
        $converter = new HtmlConverter();
        $converter->getEnvironment()->addConverter(new TableConverter());

        $translationStats = $converter->convert($this->twig->render('_translation-stats.html.twig', [
            'statistics' => $this->termRepository->getStatisticsByPack(),
        ]));
        $readmePath = sprintf('%s/README.md', $path);
        $moduleReadme = preg_replace(
            '/<!-- STATS - BEGIN -->(.*)<!-- STATS - END -->/sm',
            "<!-- STATS - BEGIN -->\n".$translationStats."\n<!-- STATS - END -->",
            file_get_contents($readmePath)
        );

        $filesystem->dumpFile($readmePath, $moduleReadme);

        $io->success('Mise à jour du module terminée !');

        return Command::SUCCESS;
    }
}
