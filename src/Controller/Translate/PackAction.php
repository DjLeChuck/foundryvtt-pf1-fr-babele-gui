<?php

namespace App\Controller\Translate;

use App\Manager\TranslationManager;
use App\Repository\TermRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/translate/{pack}', name: 'app_translate_pack')]
class PackAction extends AbstractController
{
    public function __invoke(
        Request $request,
        string $pack,
        TermRepository $termRepository,
        TranslationManager $translationManager,
        PaginatorInterface $paginator
    ): Response {
        $filter = $request->request->get('filter');

        if (empty($filter)) {
            $translations = $request->request->all('translation');
            if (!empty($translations)) {
                if (!$this->isCsrfTokenValid('translate', $request->request->get('_csrf_token'))) {
                    throw $this->createAccessDeniedException();
                }

                foreach ($translations as $termId => $data) {
                    $translationManager->updateTranslation($termId, $data);
                }

                $translationManager->flush();
            }
        } elseif (!$this->isCsrfTokenValid('translate', $request->request->get('_csrf_token'))) {
            throw $this->createAccessDeniedException();
        }

        return $this->render('translate/pack.html.twig', [
            'pack'       => $pack,
            'filter'     => $filter,
            'pagination' => $paginator->paginate(
                $termRepository->getByPackQuery($pack, $filter),
                $request->query->getInt('page', 1),
                20
            ),
        ]);
    }
}
