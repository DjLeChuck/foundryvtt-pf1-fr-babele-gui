<?php

namespace App\Formatter;

use App\Entity\TermInterface;

interface TermFormatterInterface
{
    public function supports(string $pack): bool;

    public function format(string $pack, array $dataset): TermInterface;
}
