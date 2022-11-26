<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'app_term_class')]
class TermClass extends Term
{
    #[ORM\Column(length: 255, nullable: true)]
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
