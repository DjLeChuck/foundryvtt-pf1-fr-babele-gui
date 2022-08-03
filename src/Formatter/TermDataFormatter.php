<?php

namespace App\Formatter;

use App\DTO\Term;

class TermDataFormatter
{
    /** @var TermFormatterInterface[] */
    private iterable $formatters;

    public function __construct(iterable $formatters)
    {
        $this->formatters = $formatters;
    }

    public function format(string $pack, array $data): Term
    {
        foreach ($this->formatters as $formatter) {
            if ($formatter->supports($pack)) {
                return $formatter->format($data);
            }
        }

        throw new \InvalidArgumentException(sprintf('Aucun formatter ne supporte le pack %s', $pack));
    }
}
