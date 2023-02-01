<?php

namespace App\Controller;

use App\Repository\KillerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardProController extends AbstractController
{
    #[Route('/dashboard', name: 'app_dashboard')]
    public function index(KillerRepository $killerRepository): Response
    {
        return $this->render('dashboard_pro/index.html.twig', [
            'killers' => $killerRepository->findAll(),
        ]);
    }
}
