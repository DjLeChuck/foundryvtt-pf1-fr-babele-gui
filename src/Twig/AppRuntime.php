<?php

declare(strict_types=1);

namespace App\Twig;

use App\Entity\TermTranslationBestiary;
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

            // Cas particulier -> Image des bestiaires toujours affichée
            if ('img' === $child->vars['name'] && $child->parent->vars['data'] instanceof TermTranslationBestiary) {
                $result[] = $child;

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
