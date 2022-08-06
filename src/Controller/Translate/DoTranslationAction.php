<?php

namespace App\Controller\Translate;

use App\Google\Translator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/translate/do-translation', name: 'app_translate_do_translation', methods: 'POST')]
class DoTranslationAction extends AbstractController
{
    public function __invoke(Translator $translator, Request $request): JsonResponse
    {
        return $this->json(['text' => $translator->translate($request->request->get('text'))]);
    }
}
