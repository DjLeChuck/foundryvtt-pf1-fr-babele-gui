<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'app_term')]
#[ORM\Index(columns: ['name'], name: 'term_name_idx')]
#[ORM\Index(columns: ['pack'], name: 'term_pack_idx')]
class Term
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column(length: 255)]
    private ?string $pack = null;

    #[ORM\OneToOne(inversedBy: 'term', cascade: ['persist', 'remove'])]
    private ?TermTranslation $translation = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getPack(): ?string
    {
        return $this->pack;
    }

    public function setPack(string $pack): void
    {
        $this->pack = $pack;
    }

    public function getTranslation(): ?TermTranslation
    {
        return $this->translation;
    }

    public function setTranslation(?TermTranslation $translation): self
    {
        $this->translation = $translation;

        return $this;
    }

    public function nameSeemsUntranslated(): bool
    {
        if (empty($this->getName()) || $this->getTranslation()?->isApproved()) {
            return false;
        }

        return null === $this->getTranslation() ||
            empty($this->getTranslation()->getName()) ||
            $this->getName() === $this->getTranslation()->getName();
    }

    public function descriptionSeemsUntranslated(): bool
    {
        if (empty($this->getDescription()) || $this->getTranslation()?->isApproved()) {
            return false;
        }

        return null === $this->getTranslation() ||
            empty($this->getTranslation()->getDescription()) ||
            $this->getDescription() === $this->getTranslation()->getDescription();
    }

    public function translationLevel(): int
    {
        return ($this->nameSeemsUntranslated() ? 0 : 1) + ($this->descriptionSeemsUntranslated() ? 0 : 1);
    }
}
