<?php

namespace App\Controller;

use DateTime;
use App\Entity\Update;
use DateTimeImmutable;
use App\Form\UpdateFormType;
use App\Form\TicketsTypeCreate;
use App\Form\TicketsTypeUpdate;
use App\Repository\UpdateRepository;
use App\Repository\TicketsRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/update')]
class UpdateController extends AbstractController
{
    #[Route('/', name: 'app_update')]
    public function index(UpdateRepository $updateRepository): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        return $this->render('update/index.html.twig', [
            'update' => $updateRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_update_new', methods: ['GET', 'POST'])]
    public function new(Request $request, UpdateRepository $updateRepository): Response
    {
        $date = new DateTimeImmutable();
        $update = new Update();
        
        $form = $this->createForm(UpdateFormType::class, $update);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $update->getStatut();
            $update->setUpdatedAt($date);
            $update->getRapport();
            $update->getTicket();
            $updateRepository->save($update, true);

            return $this->redirectToRoute('app_update_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('update/index.html.twig', [
            'update' => $update,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_update_show', methods: ['GET'])]
    public function show(Update $update): Response
    {
        return $this->render('update/show.html.twig', [
            'update' => $update,
        ]);
    }
}