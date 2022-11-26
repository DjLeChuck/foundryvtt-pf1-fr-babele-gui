<?php

namespace App\Controller\Translate;

use App\Form\Term\ListType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/translate', name: 'app_translate_pack_process', methods: 'POST')]
class ProcessPackTranslationAction extends AbstractController
{
    public function __invoke(Request $request, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ListType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            $this->addFlash('success', 'Traductions enregistrées.');
        }

        return $this->redirect(
            $request->headers->get(
                'referer',
                $request->request->get('_redirect', $this->generateUrl('app_home'))
            )
        );
    }
}
