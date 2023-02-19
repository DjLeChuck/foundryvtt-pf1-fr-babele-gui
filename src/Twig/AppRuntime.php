<?php

declare(strict_types=1);

namespace App\Twig;

use App\Entity\TermTranslationBestiary;
use App\Entity\TermTranslationSpell;
use App\Form\CompendiumSearchType;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\FormView;
use Twig\Extension\RuntimeExtensionInterface;

class AppRuntime implements RuntimeExtensionInterface
{
    private FormFactoryInterface $formFactory;

    public function __construct(FormFactoryInterface $formFactory)
    {
        $this->formFactory = $formFactory;
    }

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

            // Cas particulier -> Description des sorts toujours affichée
            if ('description' === $child->vars['name'] && $child->parent->vars['data'] instanceof TermTranslationSpell) {
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

    public function getCompendiumSearchForm(): FormView
    {
        return $this->formFactory->create(CompendiumSearchType::class)->createView();
    }
}
