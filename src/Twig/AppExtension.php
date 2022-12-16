<?php

declare(strict_types=1);

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class AppExtension extends AbstractExtension
{
    public function getFilters(): array
    {
        return [
            new TwigFilter('filter_displayable', [AppRuntime::class, 'filterDisplayable']),
        ];
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('compendium_search_form', [AppRuntime::class, 'getCompendiumSearchForm']),
        ];
    }
}
