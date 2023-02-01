<?php

namespace App\Controller;

use App\Entity\Killer;
use App\Repository\KillerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ChoiceProController extends AbstractController
{
    #[Route('/choice', name: 'app_choice')]
    public function index(KillerRepository $killerRepository): Response
    {
        return $this->render('choiceUser/index.html.twig', [
            'killers' => $killerRepository->findAll(),
        ]);
    }

    #[Route('/choice/{killer}', methods: ['GET'], name: 'app_choice_killer')]
    public function choiceKiller(
        KillerRepository $killerRepository,
        Killer $killer
    ): Response
    {
        return $this->render('choiceUser/targetKill.html.twig', [
            'killer' => $killer,
        ]);
    }
}
