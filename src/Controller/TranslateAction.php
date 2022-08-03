<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/translate', name: 'app_translate')]
class TranslateAction extends AbstractController
{
    public function __invoke(): Response
    {
        return $this->render('translate.html.twig');
    }
}
