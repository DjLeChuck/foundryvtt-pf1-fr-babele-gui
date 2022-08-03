<?php

namespace App\Controller;

use App\Repository\TermRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/translate', name: 'app_translate')]
class TranslateAction extends AbstractController
{
    public function __invoke(TermRepository $termRepository): Response
    {
        return $this->render('translate.html.twig', [
            'packs' => $termRepository->findPacks(),
        ]);
    }
}
