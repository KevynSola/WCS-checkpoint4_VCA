<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_landing')]
    public function index(): Response
    {
        return $this->render('home/landing.html.twig');
    }

    #[Route('/legal-notices', name: 'app_legal')]
    public function legal(): Response
    {
        return $this->render('legalNotices/index.html.twig');
    }
}
