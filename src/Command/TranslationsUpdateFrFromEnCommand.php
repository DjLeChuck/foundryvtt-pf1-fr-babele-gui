<?php

namespace App\Command;

use NestedJsonFlattener\Flattener\Flattener;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Serializer\SerializerInterface;

#[AsCommand(
    name: 'app:translations:update-fr-from-en',
    description: 'Met à jour le fichier de traductions FR du système Pathfinder à partir du fichier EN',
)]
class TranslationsUpdateFrFromEnCommand extends Command
{
    public function __construct(SerializerInterface $serializer)
    {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $filesystem = new Filesystem();

        if (!$filesystem->exists([$this->getFilePath('en'), $this->getFilePath('fr')])) {
            $io->error('Un des deux fichiers est manquant dans var/pf1');

            return self::FAILURE;
        }

        $en = $this->loadEN();
        $enKeys = array_keys($en);
        $fr = $this->loadFR();
        $frKeys = array_keys($fr);

        foreach (array_diff($enKeys, $frKeys) as $keyToAdd) {
            $fr[$keyToAdd] = '__'.$en[$keyToAdd];
        }

        foreach (array_diff($frKeys, $enKeys) as $keyToDelete) {
            unset($fr[$keyToDelete]);
        }

        $this->dumpNewFrFile($fr);

        return Command::SUCCESS;
    }

    private function loadEN(): array
    {
        return $this->loadFile('en');
    }

    private function loadFR(): array
    {
        return $this->loadFile('fr');
    }

    private function loadFile(string $locale): array
    {
        $flattener = new Flattener();
        $flattener->setArrayData(json_decode(
            file_get_contents($this->getFilePath($locale)),
            true,
            512,
            JSON_THROW_ON_ERROR
        ));

        return current($flattener->getFlatData());
    }

    private function dumpNewFrFile(array $data): void
    {
        file_put_contents(
            $this->getFilePath('fr-new'),
            json_encode($data, JSON_THROW_ON_ERROR | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT)
        );
    }

    private function getFilePath(string $locale): string
    {
        return sprintf('var/pf1/%s.json', $locale);
    }
}
