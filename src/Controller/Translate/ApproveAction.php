<?php

namespace App\Controller\Translate;

use App\Entity\Term;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/translate/approve/{id}', name: 'app_translate_approve')]
#[IsGranted('approve', 'term')]
class ApproveAction extends AbstractController
{
    public function __invoke(Request $request, Term $term, EntityManagerInterface $em): RedirectResponse
    {
        if (null === $term->getTranslation()) {
            return $this->getRedirection($request);
        }

        try {
            $term->getTranslation()->setApproved(true);
            $em->flush();
        } catch (\Throwable) {
        }

        return $this->getRedirection($request);
    }

    private function getRedirection(Request $request): RedirectResponse
    {
        return $this->redirect($request->headers->get('referer'));
    }
}
