<?php

namespace App\Command;

use App\Entity\TermTranslationBestiary;
use App\Repository\TermBestiaryRepository;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'app:tmp',
)]
class TmpCommand extends Command
{
    private TermBestiaryRepository $bestiaryRepository;

    public function __construct(TermBestiaryRepository $bestiaryRepository)
    {
        parent::__construct();

        $this->bestiaryRepository = $bestiaryRepository;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $json = file_get_contents(dirname(__DIR__).'/../var/map.json');
        $img = [];

        foreach (json_decode($json, true, 512, JSON_THROW_ON_ERROR) as $bestiary) {
            foreach ($bestiary as $item) {
                $parts = explode('/', $item['actor']);
                $img[str_replace('.webp', '', array_pop($parts))] = str_replace(
                    '/portraits/',
                    '/__type__/',
                    $item['actor']
                );
            }
        }

        $img = array_unique($img);
        // $updated = 0;
        //
        // foreach (array_keys($img) as $item) {
        //     $parts = explode('-', $item);
        //     $names = [$item];
        //
        //     if (2 === \count($parts)) {
        //         $names[] = implode('-', array_reverse($parts));
        //     }
        //
        //     foreach ($this->bestiaryRepository->findByImgName($names) as $term) {
        //         /** @var TermTranslationBestiary $translation */
        //         $translation = $term->getTranslation();
        //         $translation->setImg($item);
        //
        //         ++$updated;
        //     }
        // }
        //
        // dump($updated);

        $str = '[';
        foreach ($img as $name => $item) {
            $str .= sprintf("('%s'),",str_replace("'", "''", $name));

        }
        $str .= '];';

        dump($str);

        return Command::SUCCESS;
    }
}
