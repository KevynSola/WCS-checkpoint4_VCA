<?php

namespace App\Controller;

use App\Entity\Killer;
use App\Entity\Target;
use App\Form\TargetType;
use App\Repository\KillerRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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

    #[Route('/choice/{killer}', methods: ['GET', 'POST'], name: 'app_choice_killer')]
    public function choiceKiller(
        Request $request,
        KillerRepository $killerRepository,
        Killer $killer,
        EntityManagerInterface $entityManager
    ): Response
    {
        $target = new Target();
        $form = $this->createForm(TargetType::class, $target);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $killer; // set kill target.

            $entityManager->persist($target);
            $entityManager->flush();

            return $this->redirectToRoute('app_valid_order');
        }

        return $this->render('choiceUser/targetKill.html.twig', [
            'killer' => $killer,
            'targetForm' => $form->createView(),
        ]);
    }

    #[Route('/valid-order', name: 'app_valid_order')]
    public function validOrder(): Response
    {
        return $this->render('choiceUser/validOrder.html.twig');
    }
}
