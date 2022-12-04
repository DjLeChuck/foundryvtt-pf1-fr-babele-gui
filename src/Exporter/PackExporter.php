<?php

namespace App\Exporter;

use App\Repository\TermRepository;
use App\Repository\TermRepositoryInterface;
use App\Serializer\Callback;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Serializer\Encoder\JsonEncode;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\SerializerInterface;

class PackExporter
{
    private array $configuration;
    private TermRepository $termRepository;
    private SerializerInterface $serializer;
    private Callback $callback;
    private EntityManagerInterface $entityManager;

    public function __construct(
        array $configuration,
        TermRepository $termRepository,
        SerializerInterface $serializer,
        Callback $callback,
        EntityManagerInterface $entityManager
    ) {
        $this->configuration = $configuration;
        $this->termRepository = $termRepository;
        $this->serializer = $serializer;
        $this->callback = $callback;
        $this->entityManager = $entityManager;
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

                if (!isset($configuration['entity'])) {
                    throw new \InvalidArgumentException(sprintf('Pas d\'entité configurée pour le pack "%s"', $pack));
                }

                $dto = new $configuration['dto']($this->getEntries($configuration['entity'], $pack));

                if (isset($configuration['label'])) {
                    $dto->label = $configuration['label'];
                }

                $callback = $this->callback;

                file_put_contents(
                    $this->getPath($path, $configuration['packName']),
                    $this->serializer->serialize(
                        $dto,
                        JsonEncoder::FORMAT,
                        [
                            JsonEncode::OPTIONS => JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES,
                            AbstractNormalizer::CALLBACKS => [
                                'entries' => static function ($terms) use ($pack, $callback) {
                                    return $callback($pack, $terms);
                                },
                            ],
                        ]
                    )
                );
            } catch (\Throwable $e) {
                $io->error(sprintf('Erreur lors du traitement : %s', $e->getMessage()));
            }
        }
    }

    private function getEntries(string $entity, string $pack): iterable
    {
        /** @var TermRepositoryInterface $repository */
        $repository = $this->entityManager->getRepository($entity);

        return $repository->findForExport(str_starts_with($pack, 'bestiary-') ? $pack : null);
    }

    private function getPath(string $path, string $packName): string
    {
        return sprintf('%s/%s', rtrim($path, '/'), $packName);
    }
}
