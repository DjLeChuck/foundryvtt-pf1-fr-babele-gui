<?php

namespace App\Formatter;

use App\Entity\TermInterface;

class TermDataFormatter
{
    /** @var TermFormatterInterface[] */
    private iterable $formatters;

    public function __construct(iterable $formatters)
    {
        $this->formatters = $formatters;
    }

    public function format(string $pack, array $data): TermInterface
    {
        foreach ($this->formatters as $formatter) {
            if ($formatter->supports($pack)) {
                return $formatter->format($pack, $data);
            }
        }

        throw new \InvalidArgumentException(sprintf('Aucun formatter ne supporte le pack %s', $pack));
    }
}
