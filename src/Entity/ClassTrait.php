<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

trait ClassTrait
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
