<?php

namespace App\Controller;



use App\Repository\ClientRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class CallAjaxControllerClient extends AbstractController
{
    /*recuperation des elements de la table client pour l'afficher en format Json sur cette route*/
    #[Route('/ajax/listeClients', name: 'app_call_ajax')]
    public function index(ClientRepository $repository, NormalizerInterface $normalizer): JsonResponse
    {
        $client = $repository->findAll();


        $result = $normalizer->normalize($client, 'json', ['groups' => 'show_product']);
        return $this->json(
            $result
        );
    }
}
