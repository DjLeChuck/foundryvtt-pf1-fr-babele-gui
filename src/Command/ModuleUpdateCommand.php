<?php

namespace App\Command;

use App\Repository\TermRepository;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Process\Process;
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
        $this
            ->addArgument('path', InputArgument::REQUIRED, 'Répertoire du module')
            ->addOption('bump-json', 'b', InputOption::VALUE_NONE, 'Si présent, bump la version du fichier module.json')
        ;
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
        // $command = $this->getApplication()?->find('app:export:packs');
        // if (null === $command) {
        //     $io->error('Commande d\'export des packs introuvable.');
        //
        //     return self::FAILURE;
        // }
        //
        // $greetInput = new ArrayInput(['path' => $packExportPath]);
        //
        // try {
        //     $returnCode = $command->run($greetInput, $output);
        //
        //     if (self::SUCCESS !== $returnCode) {
        //         throw new \RuntimeException(sprintf('Code de sortie en erreur (%u)', $returnCode));
        //     }
        // } catch (\Throwable $e) {
        //     $io->error(sprintf('Erreur lors de l\'export des packs : %s', $e->getMessage()));
        //
        //     return self::FAILURE;
        // }
        //
        // $io->info('Mise à jour des stats de traduction dans le README.md');
        // $converter = new HtmlConverter();
        // $converter->getEnvironment()->addConverter(new TableConverter());
        //
        // $translationStats = $converter->convert($this->twig->render('_translation-stats.html.twig', [
        //     'statistics' => $this->termRepository->getStatisticsByPack(),
        // ]));
        // $readmePath = sprintf('%s/README.md', $path);
        // $moduleReadme = preg_replace(
        //     '/<!-- STATS - BEGIN -->(.*)<!-- STATS - END -->/sm',
        //     "<!-- STATS - BEGIN -->\n".$translationStats."\n<!-- STATS - END -->",
        //     file_get_contents($readmePath)
        // );
        //
        // $filesystem->dumpFile($readmePath, $moduleReadme);

        if ($input->getOption('bump-json')) {
            $moduleJsonPath = sprintf('%s/module.json', $path);
            if (!is_file($moduleJsonPath)) {
                $io->error(sprintf('Fichier module.json introuvable dans %s', $path));

                return self::FAILURE;
            }

            try {
                $moduleJson = json_decode(file_get_contents($moduleJsonPath), true, 512, JSON_THROW_ON_ERROR);
            } catch (\Throwable) {
                $io->error('Impossible de décoder le fichier module.json');

                return self::FAILURE;
            }

            $currentVersion = $moduleJson['version'];
            [$major, $minor, $patch] = explode('.', $currentVersion);
            $newVersion = sprintf('%u.%u.%u', $major, $minor, ++$patch);

            $moduleJson['version'] = $newVersion;
            $moduleJson['download'] = str_replace($currentVersion, $newVersion, $moduleJson['download']);

            try {
                $newModuleJson = json_encode(
                    $moduleJson,
                    JSON_THROW_ON_ERROR | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT
                );
                // Indente sur 2 espaces au lieu de 4
                $newModuleJson = preg_replace('/^(  +?)\\1(?=[^ ])/m', '$1', $newModuleJson);

                $filesystem->dumpFile(
                    $moduleJsonPath,
                    $newModuleJson
                );

                $io->success('Fichier module.json mis à jour !');
            } catch (\Throwable) {
                $io->error('Impossible d\'encoder le fichier module.json');

                return self::FAILURE;
            }

            $changelogPath = sprintf('%s/CHANGELOG.md', $path);
            if (!is_file($changelogPath)) {
                $io->error(sprintf('Fichier CHANGELOG.md introuvable dans %s', $path));

                return self::FAILURE;
            }

            $date = date('Y-m-d');
            $newChangeChangelog = <<<TXT
## [Unreleased]

## [$newVersion] - $date

### Updated

- Bump translations

TXT;
            $newLinkChangelog = <<<TXT
[Unreleased]: https://github.com/DjLeChuck/foundryvtt-pf1-fr-babele/compare/$newVersion...HEAD

[$newVersion]: https://github.com/DjLeChuck/foundryvtt-pf1-fr-babele/compare/$currentVersion...$newVersion

TXT;

            try {
                $filesystem->dumpFile(
                    $changelogPath,
                    str_replace([
                        "## [Unreleased]\n",
                        "[Unreleased]: https://github.com/DjLeChuck/foundryvtt-pf1-fr-babele/compare/$currentVersion...HEAD\n",
                    ], [
                        $newChangeChangelog,
                        $newLinkChangelog,
                    ],
                        file_get_contents($changelogPath)
                    )
                );

                $io->success('Fichier CHANGELOG.md mis à jour !');
            } catch (\Throwable) {
                $io->error('Impossible de modifier le fichier CHANGELOG.md');

                return self::FAILURE;
            }

            // Création du nouveau tag
            $process = new Process([
                'git', 'tag', '-a', $newVersion,
                '-m', sprintf('v%s - %s', $newVersion, date('Y-m-d')),
            ], $path);

            try {
                $process->mustRun();

                $io->success(sprintf('Tag %s créé !', $newVersion));
            } catch (\Throwable $e) {
                $io->error('Impossible de taguer le dépôt :');
                $io->error($e->getMessage());

                return self::FAILURE;
            }
        }

        $io->success('Mise à jour du module terminée !');

        return Command::SUCCESS;
    }
}
