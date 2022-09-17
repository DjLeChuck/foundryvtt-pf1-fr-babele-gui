<?php

namespace App\Controller\Translate;

use App\Manager\TranslationManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/translate', name: 'app_translate_pack_process', methods: 'POST')]
class ProcessPackTranslationAction extends AbstractController
{
    public function __invoke(Request $request, TranslationManager $translationManager): Response
    {
        if (!$this->isCsrfTokenValid('translate', $request->request->get('_csrf_token'))) {
            throw $this->createAccessDeniedException();
        }

        $translations = $request->request->all('translation');
        if (!empty($translations)) {
            foreach ($translations as $termId => $data) {
                $translationManager->updateTranslation($termId, $data);
            }

            $translationManager->flush();

            $this->addFlash('success', 'Traductions enregistrées.');
        }

        return $this->redirect($request->headers->get(
            'referer',
            $request->request->get('_redirect', $this->generateUrl('app_home'))
        ));
    }
}
