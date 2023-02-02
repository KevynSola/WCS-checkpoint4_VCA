<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Killer;
use App\Entity\Target;
use App\Form\TargetType;
use App\Repository\KillerRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/visitor')]
class ChoiceProController extends AbstractController
{
    #[Route('/choice', name: 'app_choice')]
    public function index(KillerRepository $killerRepository): Response
    {
        /** @var User $user  */
        $user = $this->getUser();
        $roles = $user->getRoles();
        
        if($roles[0] === 'ROLE_KILLER'){
            return $this->redirectToRoute('app_dashboard');
        };

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
        /** @var User $user  */
        $user = $this->getUser();

        $target = new Target();
        $form = $this->createForm(TargetType::class, $target);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $target->setKiller($killer);
            $target->setUser($user);

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
