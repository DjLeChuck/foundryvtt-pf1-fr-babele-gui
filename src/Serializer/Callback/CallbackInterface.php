<?php

declare(strict_types=1);

namespace App\Serializer\Callback;

use App\Entity\TermInterface;

interface CallbackInterface
{
    public function supports(string $pack): bool;

    /**
     * @param TermInterface[] $terms
     *
     * @return array
     */
    public function process(iterable $terms): array;
}
