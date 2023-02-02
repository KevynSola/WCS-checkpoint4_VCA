<?php

namespace App\Controller;

use App\Entity\Target;
use App\Form\TargetType;
use App\Repository\TargetRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/killer/target')]
class TargetController extends AbstractController
{
    /* #[Route('/', name: 'app_target_index', methods: ['GET'])]
    public function index(TargetRepository $targetRepository): Response
    {
        return $this->render('target/index.html.twig', [
            'targets' => $targetRepository->findAll(),
        ]);
    } */

    /* #[Route('/new', name: 'app_target_new', methods: ['GET', 'POST'])]
    public function new(Request $request, TargetRepository $targetRepository): Response
    {
        $target = new Target();
        $form = $this->createForm(Target1Type::class, $target);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $targetRepository->save($target, true);

            return $this->redirectToRoute('app_target_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('target/new.html.twig', [
            'target' => $target,
            'form' => $form,
        ]);
    } */

    /* #[Route('/{id}', name: 'app_target_show', methods: ['GET'])]
    public function show(Target $target): Response
    {
        return $this->render('target/show.html.twig', [
            'target' => $target,
        ]);
    } */

    #[Route('/{target}/edit', name: 'app_target_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Target $target, TargetRepository $targetRepository): Response
    {
        /** @var Target $target  */
        
        $form = $this->createForm(TargetType::class, $target);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $targetRepository->save($target, true);
            // send alert to kill

            return $this->redirectToRoute('app_dashboard', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('target/edit.html.twig', [
            'target' => $target,
            'form' => $form,
        ]);
    }

    #[Route('/{target}', name: 'app_target_delete', methods: ['POST'])]
    public function delete(Request $request, Target $target, TargetRepository $targetRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$target->getId(), $request->request->get('_token'))) {
            $targetRepository->remove($target, true);
        }

        return $this->redirectToRoute('app_dashboard', [], Response::HTTP_SEE_OTHER);
    }
}
