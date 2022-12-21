<?php

namespace App\Controller;

use DateTime;
use App\Entity\Update;
use DateTimeImmutable;
use App\Entity\Tickets;
use App\Form\TicketsTypeCreate;
use App\Form\TicketsTypeUpdate;
use App\Repository\UpdateRepository;
use App\Repository\TicketsRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/tickets')]
class TicketsController extends AbstractController
{
    #[Route('/', name: 'app_tickets_index', methods: ['GET'])]
    public function index(TicketsRepository $ticketsRepository, ): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        return $this->render('tickets/index.html.twig', [
            'tickets' => $ticketsRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_tickets_new', methods: ['GET', 'POST'])]
    public function new(Request $request, TicketsRepository $ticketsRepository): Response
    {
        $date = new DateTimeImmutable();
        $ticket = new Tickets();
        
        $form = $this->createForm(TicketsTypeCreate::class, $ticket);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $ticket->setUser($this->getUser());
            $ticket->setStatut('NOUVEAU');
            $ticket->setCreatedAt($date);
            $ticketsRepository->save($ticket, true);

            return $this->redirectToRoute('tickets.list.all', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('tickets/new.html.twig', [
            'ticket' => $ticket,
            'form' => $form,
        ]);
    }

    //'{page?1}' : affiche la première page, par défaut ayant le numéro 1
    //'{nbre?5}' : nombre maximum de tickets visibles sur une page
    #[Route('/all/{page?1}/{nbre?5}', name: 'tickets.list.all')]
    public function indexAll(ManagerRegistry $doctrine, $page, $nbre): Response
    {
        //on va chercher la classe 'tickets'
        $repository = $doctrine->getRepository(Tickets::class);
        //répertorier le nombre de tickets
        $nbTicket = $repository->count([]);
        //on calcule le nombre de page en divisant le nombre de ticket total par le nombre de tickets max par page
        //'ceil' : Arrondi à l'entier suppérieur
        $nbPage = ceil($nbTicket / $nbre);
        //'findBy': on va trouver un objet selon certains critères
        $ticket = $repository->findBy([], [], $nbre, ($page - 1) * $nbre);
        return $this->render('tickets/index.html.twig', [
            //le ticket
            'tickets' => $ticket,
            //pagination paramétrée sur 'true'
            'isPaginated' => true,
            //le nombre de pages
            'nbPages' => $nbPage,
            'page' => $page,
            'nbre' => $nbre
        ]);
    }

    #[Route('/{id}', name: 'app_tickets_show', methods: ['GET'])]
    public function show(Tickets $ticket): Response
    {
        return $this->render('tickets/show.html.twig', [
            'ticket' => $ticket,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_tickets_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Tickets $ticket, TicketsRepository $ticketsRepository): Response
    {
        $date = new DateTime();

        $form = $this->createForm(TicketsTypeUpdate::class, $ticket);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $ticket->setUpdatedAt($date);
            $ticketsRepository->save($ticket, true);

            return $this->redirectToRoute('app_tickets_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('tickets/edit.html.twig', [
            'ticket' => $ticket,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_tickets_delete', methods: ['POST'])]
    public function delete(Request $request, Tickets $ticket, TicketsRepository $ticketsRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ticket->getId(), $request->request->get('_token'))) {
            $ticketsRepository->remove($ticket, true);
        }

        return $this->redirectToRoute('app_tickets_index', [], Response::HTTP_SEE_OTHER);
    }
}