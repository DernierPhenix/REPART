<?php

namespace App\Controller;


use App\Repository\SousCategorieRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class CallAjaxControllerSousCategorie extends AbstractController
{

    /*recuperation des elements de la table Sous Categorie pour l'afficher en format Json sur cette route*/
    #[Route('/ajax/SousCategorie', name: 'app_call_ajax_sousCategorie')]
    public function indexcat(SousCategorieRepository $repository, NormalizerInterface $normalizer): JsonResponse
    {
        $sousCategorie = $repository->findAll();


        $result = $normalizer->normalize($sousCategorie, 'json', ['groups' => 'show_product']);
        return $this->json(
            $result
        );
    }
}