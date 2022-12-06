<?php

namespace App\Controller;

use App\Entity\Categories;
use App\Form\CategoriesType;
use App\Repository\CategoriesRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

/* L'annotation IsGranted restreint l'accès aux contrôleurs */
#[
    Route('/categories'),
    IsGranted('ROLE_USER')
]

class CategoriesController extends AbstractController
{
    #[Route('/', name: 'app_categories_index', methods: ['GET'])]
    public function index(CategoriesRepository $categoriesRepository): Response
    {
        /*Ici l'acces est autorisé que si un utilisateur est authentifié */
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        return $this->render('categories/index.html.twig', [
            'categories' => $categoriesRepository->findAll(),
        ]);
    }


    #[Route('/new', name: 'app_categories_new', methods: ['GET', 'POST'])]
    public function new(Request $request, CategoriesRepository $categoriesRepository, SluggerInterface $slugger): Response
    {
        $category = new Categories();
        $form = $this->createForm(CategoriesType::class, $category);
        $form->handleRequest($request);

        $image = $form->get('image')->getData();

        // création du nom d'un nouveau fichier 
        if ($image) {
            $originalFilename = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
            // ceci est nécessaire pour inclure en toute sécurité le nom du fichier dans l'URL
            $safeFilename = $slugger->slug($originalFilename);
            // recupere le nouveau nom du fichier  lui concatene avec un numéro unique 
            $newFilename = $safeFilename . '-' . uniqid() . '.' . $image->guessExtension();

            // Déplacez le fichier dans le répertoire où sont stockées les brochures 
            try {
                $image->move(
                    $this->getParameter('categories_directory'),
                    $newFilename
                );
            } catch (FileException $e) {
                // ... gére l'exception si quelque chose se produit pendant le téléchargement du fichier
            }

            // met à jour la propriété 'categorieFilename' pour stocker le nom du fichier 
            // à la place de son contenu
            $category->setImage($newFilename);
        }

        if ($form->isSubmitted() && $form->isValid()) {
            $categoriesRepository->save($category, true);

            return $this->redirectToRoute('app_categories_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('categories/new.html.twig', [
            'category' => $category,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_categories_show', methods: ['GET'])]
    public function show(Categories $category): Response
    {
        return $this->render('categories/show.html.twig', [
            'category' => $category,
        ]);
    }

    #[
        Route('/{id}/edit', name: 'app_categories_edit', methods: ['GET', 'POST']),
        IsGranted('ROLE_ADMIN')
        ]
    public function edit(Request $request, Categories $category, CategoriesRepository $categoriesRepository): Response
    {
        /*Ici fonction uniquement accessible si un utilisateur est authentifié en tant que ADMIN */
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        $form = $this->createForm(CategoriesType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $categoriesRepository->save($category, true);

            return $this->redirectToRoute('app_categories_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('categories/edit.html.twig', [
            'category' => $category,
            'form' => $form,
        ]);
    }

    #[
        Route('/{id}', name: 'app_categories_delete', methods: ['POST']),
        IsGranted('ROLE_ADMIN')
    ]
    public function delete(Request $request, Categories $category, CategoriesRepository $categoriesRepository): Response
    {
        /*Ici fonction uniquement accessible si un utilisateur est authentifié en tant que ADMIN */
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        if ($this->isCsrfTokenValid(
            'delete' . $category->getId(),
            $request->request->get('_token')
        )) {
            $categoriesRepository->remove($category, true);
        }

        return $this->redirectToRoute('app_categories_index', [], Response::HTTP_SEE_OTHER);
    }
}