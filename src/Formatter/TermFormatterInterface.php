<?php

namespace App\Formatter;

use App\DTO\Term;

interface TermFormatterInterface
{
    public function supports(string $pack): bool;

    public function format(array $dataset): Term;
}
