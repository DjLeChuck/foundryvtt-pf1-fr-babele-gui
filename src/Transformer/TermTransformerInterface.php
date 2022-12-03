<?php

declare(strict_types=1);

namespace App\Transformer;

interface TermTransformerInterface
{
    public function transform(iterable $terms): array;
}
