<?php

namespace App\Controller;

use App\Repository\TargetRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/visitor')]
class AccountController extends AbstractController
{
    #[Route('/account', name: 'app_account')]
    public function index(TargetRepository $targetRepository): Response
    {
        $user = $this->getUser();
        $userId = $user->getId();
        
        $targets = $targetRepository->findBy([
            'user' => $userId
        ]);
        return $this->render('account/index.html.twig', [
            'targets' => $targets,
        ]);
    }
}
