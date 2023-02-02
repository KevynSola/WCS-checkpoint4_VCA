<?php

namespace App\Controller;

use App\Repository\KillerRepository;
use App\Repository\TargetRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/killer')]
class DashboardProController extends AbstractController
{
    #[Route('/dashboard', name: 'app_dashboard')]
    public function index(
        KillerRepository $killerRepository,
        TargetRepository $targetRepository
    ): Response
    {
        $user = $this->getUser();
        $killer = $user->getKiller();
        $killerId = $killer->getId();
        
        $targets = $targetRepository->findBy([
            'killer' => $killerId
        ]);
        return $this->render('dashboard_pro/index.html.twig', [
            'targets' => $targets,
            'killer' => $killer,
        ]);
    }
}
