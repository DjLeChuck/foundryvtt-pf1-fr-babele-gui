<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Event\PreUpdateEventArgs;

interface TermTranslationInterface
{
    public function getId(): ?int;

    public function setId(?int $id): void;

    public function getName(): ?string;

    public function setName(string $name): void;

    public function getDescription(): ?string;

    public function setDescription(string $description): void;

    public function getTerm(): ?Term;

    public function setTerm(?Term $term): \App\Entity\TermTranslation;

    public function getUpdatedBy(): ?string;

    public function isApproved(): bool;

    public function setApproved(bool $approved): void;

    public function resetApprovement(PreUpdateEventArgs $eventArgs): void;
}
