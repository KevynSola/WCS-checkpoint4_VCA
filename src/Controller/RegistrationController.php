<?php

namespace App\Controller;

use App\Entity\Killer;
use App\Entity\User;
use App\Form\RegistrationKillerType;
use App\Form\RegistrationType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class RegistrationController extends AbstractController
{
    #[Route('/register-user', name: 'app_register_user')]
    public function registerUser(
        Request $request,
        UserPasswordHasherInterface $userPasswordHasher,
        EntityManagerInterface $entityManager
    ): Response
    {

        $user = new User();
        $form = $this->createForm(RegistrationType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );

            $entityManager->persist($user);
            $entityManager->flush();
            // do anything else you need here, like send an email or flash message

            return $this->redirectToRoute('app_login_user');
        }

        return $this->render('registration/indexUser.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }

    #[Route('/register-killer', name: 'app_register_killer')]
    public function registerKiller(
        Request $request,
        UserPasswordHasherInterface $killerPasswordHasher,
        EntityManagerInterface $entityManager
    ): Response
    {

        $killer = new Killer();
        $form = $this->createForm(RegistrationKillerType::class, $killer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $killer->setPassword(
                $killerPasswordHasher->hashPassword(
                    $killer,
                    $form->get('plainPassword')->getData()
                )
            );

            $entityManager->persist($killer);
            $entityManager->flush();
            // do anything else you need here, like send an email or flash message

            return $this->redirectToRoute('app_login_killer');
        }

        return $this->render('registration/indexKiller.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }
}
