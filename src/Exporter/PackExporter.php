<?php

namespace App\Exporter;

use App\Repository\TermRepository;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Serializer\Encoder\JsonEncode;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\SerializerInterface;

class PackExporter
{
    private array $configuration;
    private TermRepository $termRepository;
    private SerializerInterface $serializer;

    public function __construct(array $configuration, TermRepository $termRepository, SerializerInterface $serializer)
    {
        $this->configuration = $configuration;
        $this->termRepository = $termRepository;
        $this->serializer = $serializer;
    }

    public function export(string $path, SymfonyStyle $io): void
    {
        foreach ($this->termRepository->findPacks() as $pack) {
            $io->info(sprintf('Traitement du pack %s', $pack));

            try {
                $configuration = $this->configuration[$pack] ?? null;
                if (null === $configuration) {
                    throw new \InvalidArgumentException('Aucune configuration trouvée.');
                }

                $dto = new $configuration['dto']($this->getEntries($pack));

                file_put_contents($this->getPath($path, $configuration['packName']), $this->serializer->serialize(
                    $dto,
                    JsonEncoder::FORMAT,
                    [JsonEncode::OPTIONS => JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES]
                ));
            } catch (\Throwable $e) {
                $io->error(sprintf('Erreur lors du traitement : %s', $e->getMessage()));
            }
        }
    }

    private function getEntries(string $pack): array
    {
        $entries = [];

        foreach ($this->termRepository->findByPackForExport($pack) as $row) {
            $entries[$row['term']] = [
                'name'        => $row['name'],
                'description' => $row['description'],
            ];
        }

        return $entries;
    }

    private function getPath(string $path, string $packName): string
    {
        return sprintf('%s/%s', ltrim($path, '/'), $packName);
    }
}
