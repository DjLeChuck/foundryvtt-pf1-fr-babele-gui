<?php

declare(strict_types=1);

namespace App\Entity;

interface TermInterface
{
    public function getId(): ?int;

    public function setId(?int $id): void;

    public function getPackId(): ?string;

    public function setPackId(?string $packId): void;

    public function getName(): ?string;

    public function setName(string $name): void;

    public function getDescription(): ?string;

    public function setDescription(string $description): void;

    public function getPack(): ?string;

    public function setPack(string $pack): void;

    public function getTranslation(): ?TermTranslation;

    public function setTranslation(?TermTranslation $translation): \App\Entity\Term;

    public function nameSeemsUntranslated(): bool;

    public function descriptionSeemsUntranslated(): bool;

    public function translationLevel(): int;
}
