<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

#[ORM\Entity]
#[ORM\Table(name: 'app_term_translation')]
#[ORM\Index(columns: ['name'], name: 'term_translation_name_idx')]
#[ORM\HasLifecycleCallbacks]
#[Gedmo\Loggable]
#[ORM\InheritanceType('JOINED')]
#[ORM\DiscriminatorColumn(name: 'discr', type: 'string')]
#[ORM\DiscriminatorMap(['classes' => TermTranslationClass::class])]
class TermTranslation implements TermTranslationInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    protected ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Gedmo\Versioned]
    protected ?string $name = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Gedmo\Versioned]
    protected ?string $description = null;

    #[ORM\OneToOne(mappedBy: 'translation', cascade: ['persist', 'remove'])]
    protected ?Term $term = null;

    #[ORM\Column(type: Types::STRING, nullable: true)]
    #[Gedmo\Blameable(on: 'update')]
    protected string $updatedBy;

    #[ORM\Column(type: Types::BOOLEAN, options: ['default' => false])]
    protected bool $approved = false;

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

    public function getTerm(): ?Term
    {
        return $this->term;
    }

    public function setTerm(?Term $term): self
    {
        // unset the owning side of the relation if necessary
        if ($term === null && $this->term !== null) {
            $this->term->setTranslation(null);
        }

        // set the owning side of the relation if necessary
        if ($term !== null && $term->getTranslation() !== $this) {
            $term->setTranslation($this);
        }

        $this->term = $term;

        return $this;
    }

    public function getUpdatedBy(): ?string
    {
        return $this->updatedBy;
    }

    public function isApproved(): bool
    {
        return $this->approved;
    }

    public function setApproved(bool $approved): void
    {
        $this->approved = $approved;
    }

    #[ORM\PreUpdate]
    public function resetApprovement(PreUpdateEventArgs $eventArgs): void
    {
        if ($eventArgs->hasChangedField('name') || $eventArgs->hasChangedField('description')) {
            $this->setApproved(false);
        }
    }
}
