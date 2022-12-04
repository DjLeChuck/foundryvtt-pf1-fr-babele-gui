<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

trait ClassTrait
{
    #[ORM\Column(type: Types::JSON, nullable: true)]
    private ?array $customWeaponProf = null;

    #[ORM\Column(type: Types::JSON, nullable: true)]
    private ?array $customArmorProf = null;

    public function getCustomWeaponProf(): ?array
    {
        return $this->customWeaponProf;
    }

    public function setCustomWeaponProf(?array $customWeaponProf): void
    {
        $this->customWeaponProf = $customWeaponProf;
    }

    public function getCustomArmorProf(): ?array
    {
        return $this->customArmorProf;
    }

    public function setCustomArmorProf(?array $customArmorProf): void
    {
        $this->customArmorProf = $customArmorProf;
    }
}
