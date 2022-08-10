<?php

namespace App\Controller\Translate;

use App\DTO\FilterPack;
use App\Form\FilterPackType;
use App\Manager\TranslationManager;
use App\Repository\TermRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/translate/{pack}', name: 'app_translate_pack', methods: 'GET')]
class PackAction extends AbstractController
{
    public function __invoke(
        Request $request,
        string $pack,
        TermRepository $termRepository,
        TranslationManager $translationManager,
        PaginatorInterface $paginator
    ): Response {
        $filterPack = new FilterPack($pack);
        $form = $this->createForm(FilterPackType::class, $filterPack);

        $form->handleRequest($request);

        $form->isSubmitted() && $form->isValid();

        return $this->renderForm('translate/pack.html.twig', [
            'form'       => $form,
            'pack'       => $pack,
            'pagination' => $paginator->paginate(
                $termRepository->getByPackQuery($filterPack),
                $request->query->getInt('page', 1),
                20
            ),
        ]);
    }
}
