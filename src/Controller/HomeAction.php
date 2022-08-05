<?php

namespace App\Controller;

use App\Repository\TermRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/', name: 'app_home')]
class HomeAction extends AbstractController
{
    public function __invoke(TermRepository $termRepository): Response
    {
        return $this->render('home.html.twig', [
            'statistics' => $termRepository->getStatisticsByPack(),
        ]);
    }
}
