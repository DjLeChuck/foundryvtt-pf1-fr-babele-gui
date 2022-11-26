<?php

namespace App\Controller\Translate;

use App\DTO\FilterPack;
use App\Form\FilterPackType;
use App\Form\Term\ListType;
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
        PaginatorInterface $paginator
    ): Response {
        $filterPack = new FilterPack($pack);
        $filterForm = $this->createForm(FilterPackType::class, $filterPack);

        $filterForm->handleRequest($request);

        $filterForm->isSubmitted() && $filterForm->isValid();

        $pagination = $paginator->paginate(
            $termRepository->getByPackQuery($filterPack),
            $request->query->getInt('page', 1),
            20
        );
        $translationForm = $this->createForm(ListType::class, ['terms' => $pagination]);

        return $this->renderForm('translate/pack.html.twig', [
            'filter_form'      => $filterForm,
            'translation_form' => $translationForm,
            'pack'             => $pack,
            'pagination'       => $pagination,
        ]);
    }
}
