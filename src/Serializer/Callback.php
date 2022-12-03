<?php

declare(strict_types=1);

namespace App\Serializer;

use App\Serializer\Callback\CallbackInterface;

class Callback
{
    /** @var CallbackInterface[] */
    private iterable $callbacks;

    public function __construct(iterable $callbacks)
    {
        $this->callbacks = $callbacks;
    }

    public function __invoke(string $pack, iterable $data): array
    {
        foreach ($this->callbacks as $formatter) {
            if ($formatter->supports($pack)) {
                return $formatter->process($data);
            }
        }

        throw new \InvalidArgumentException(sprintf('Aucun callback ne supporte le pack %s', $pack));
    }
}
