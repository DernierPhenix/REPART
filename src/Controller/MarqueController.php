<?php

namespace App\Controller;

use App\Entity\Marque;
use App\Form\MarqueType;
use App\Repository\MarqueRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[
    Route('/marque'),
    IsGranted('ROLE_USER')
]
class MarqueController extends AbstractController
{
    #[Route('/', name: 'app_marque_index', methods: ['GET'])]
    public function index(MarqueRepository $marqueRepository): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        return $this->render('marque/index.html.twig', [
            'marques' => $marqueRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_marque_new', methods: ['GET', 'POST'])]
    public function new(Request $request, MarqueRepository $marqueRepository): Response
    {
        $marque = new Marque();
        $form = $this->createForm(MarqueType::class, $marque);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $marqueRepository->save($marque, true);

            return $this->redirectToRoute('app_marque_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('marque/new.html.twig', [
            'marque' => $marque,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_marque_show', methods: ['GET'])]
    public function show(Marque $marque): Response
    {
        return $this->render('marque/show.html.twig', [
            'marque' => $marque,
        ]);
    }

    #[
        Route('/{id}/edit', name: 'app_marque_edit', methods: ['GET', 'POST']),
        IsGranted('ROLE_ADMIN')
        ]
    public function edit(Request $request, Marque $marque, MarqueRepository $marqueRepository): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        $form = $this->createForm(MarqueType::class, $marque);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $marqueRepository->save($marque, true);

            return $this->redirectToRoute('app_marque_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('marque/edit.html.twig', [
            'marque' => $marque,
            'form' => $form,
        ]);
    }

    #[
        Route('/{id}', name: 'app_marque_delete', methods: ['POST']),
        IsGranted('ROLE_ADMIN')
    ]
    public function delete(Request $request, Marque $marque, MarqueRepository $marqueRepository): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        if ($this->isCsrfTokenValid('delete'.$marque->getId(), $request->request->get('_token'))) {
            $marqueRepository->remove($marque, true);
        }

        return $this->redirectToRoute('app_marque_index', [], Response::HTTP_SEE_OTHER);
    }
}