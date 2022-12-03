<?php

declare(strict_types=1);

namespace App\Transformer;

class ClassTransformer implements TermTransformerInterface
{
    public function transform(iterable $terms): array
    {
        return [];
    }
}
