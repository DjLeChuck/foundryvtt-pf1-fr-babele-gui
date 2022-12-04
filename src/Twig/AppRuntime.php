<?php

declare(strict_types=1);

namespace App\Twig;

use Symfony\Component\Form\FormView;
use Twig\Extension\RuntimeExtensionInterface;

class AppRuntime implements RuntimeExtensionInterface
{
    public function filterDisplayable(FormView $formView): array
    {
        $result = [];

        /** @var FormView $child */
        foreach ($formView as $child) {
            if ($child->isRendered()) {
                continue;
            }

            $value = $child->vars['value'];

            if (empty($value)) {
                continue;
            }

            $result[] = $child;
        }

        return $result;
    }
}
