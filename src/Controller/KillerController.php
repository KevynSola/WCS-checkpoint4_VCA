<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Killer;
use App\Form\KillerType;
use App\Repository\KillerRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/killer/profile')]
class KillerController extends AbstractController
{
    /* #[Route('/', name: 'app_killer_profile', methods: ['GET'])]
    public function index(KillerRepository $killerRepository): Response
    {
        return $this->render('killer/index.html.twig', [
            'killers' => $killerRepository->findAll(),
        ]);
    } */

    #[Route('/add/{killer}', name: 'app_killer_add', methods: ['GET', 'POST'])]
    public function new(Request $request, KillerRepository $killerRepository, Killer $killer): Response
    {
        /** @var Killer $killer  */
        
        $form = $this->createForm(KillerType::class, $killer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $killerRepository->save($killer, true);

            return $this->redirectToRoute('app_dashboard', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('killer/new.html.twig', [
            'killer' => $killer,
            'form' => $form,
        ]);
    }

    /* #[Route('/{id}', name: 'app_killer_show', methods: ['GET'])]
    public function show(Killer $killer): Response
    {
        return $this->render('killer/show.html.twig', [
            'killer' => $killer,
        ]);
    } */

    #[Route('/edit/{killer}', name: 'app_killer_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Killer $killer, KillerRepository $killerRepository): Response
    {
        $form = $this->createForm(KillerType::class, $killer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $killerRepository->save($killer, true);

            return $this->redirectToRoute('app_dashboard', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('killer/edit.html.twig', [
            'killer' => $killer,
            'form' => $form,
        ]);
    }

    /* #[Route('/{id}', name: 'app_killer_delete', methods: ['POST'])]
    public function delete(Request $request, Killer $killer, KillerRepository $killerRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$killer->getId(), $request->request->get('_token'))) {
            $killerRepository->remove($killer, true);
        }

        return $this->redirectToRoute('app_killer_index', [], Response::HTTP_SEE_OTHER);
    } */
}
