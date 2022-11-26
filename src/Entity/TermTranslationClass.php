<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'app_term_translation_class')]
class TermTranslationClass extends TermTranslation
{
    #[ORM\Column(length: 255)]
    private ?string $customWeaponProf = null;

    public function getCustomWeaponProf(): ?string
    {
        return $this->customWeaponProf;
    }

    public function setCustomWeaponProf(?string $customWeaponProf): void
    {
        $this->customWeaponProf = $customWeaponProf;
    }
}
