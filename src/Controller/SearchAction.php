<?php

namespace App\Controller;

use App\Form\GlobalSearchType;
use App\Form\Term\ListType;
use App\Repository\TermRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/search', name: 'app_search')]
class SearchAction extends AbstractController
{
    public function __invoke(Request $request, TermRepository $termRepository, PaginatorInterface $paginator): Response
    {
        $form = $this->createForm(GlobalSearchType::class);
        $translationForm = null;
        $term = null;
        $pagination = null;

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $submittedToken = $data['token'];
            if (!$this->isCsrfTokenValid('global-search', $submittedToken)) {
                $this->addFlash('danger', 'Token de recherche expiré.');

                return $this->redirectToRoute('app_home');
            }

            $term = $data['term'];
            $pagination = $paginator->paginate(
                $termRepository->getGlobalSearchQuery($term),
                $request->query->getInt('page', 1),
                20
            );
            $translationForm = $this->createForm(ListType::class, ['terms' => $pagination]);
        }

        return $this->renderForm('search.html.twig', [
            'translation_form' => $translationForm,
            'term'             => $term,
            'pagination'       => $pagination,
        ]);
    }
}
