<?php

namespace App\Manager;

use App\Entity\Term;
use App\Entity\TermTranslation;
use App\Repository\TermRepository;
use App\Repository\TermTranslationRepository;
use Doctrine\ORM\EntityManagerInterface;

class TranslationManager
{
    private TermRepository $termRepository;
    private TermTranslationRepository $termTranslationRepository;
    private EntityManagerInterface $em;

    public function __construct(
        TermRepository $termRepository,
        TermTranslationRepository $termTranslationRepository,
        EntityManagerInterface $em
    ) {
        $this->termRepository = $termRepository;
        $this->termTranslationRepository = $termTranslationRepository;
        $this->em = $em;
    }

    public function updateTranslation(int $id, array $data): void
    {
        $term = $this->termRepository->findWithTranslation($id);
        if (null === $term) {
            throw new \InvalidArgumentException(sprintf('Terme #%u inexistant', $id));
        }

        $translation = $this->getTranslation($term);
        $translation->setName($data['name']);
        $translation->setDescription($data['description'] ?? '');

        $this->termTranslationRepository->add($translation);
    }

    public function flush(): void
    {
        $this->em->flush();
    }

    private function getTranslation(Term $term): TermTranslation
    {
        if (null !== $term->getTranslation()) {
            return $term->getTranslation();
        }

        $translation = new TermTranslation();
        $translation->setTerm($term);

        return $translation;
    }
}
