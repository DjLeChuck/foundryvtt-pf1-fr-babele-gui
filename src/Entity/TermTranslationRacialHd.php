<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'app_term_translation_racial_hd')]
class TermTranslationRacialHd extends TermTranslation
{
}
