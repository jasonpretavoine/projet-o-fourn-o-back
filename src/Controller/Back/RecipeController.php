<?php

namespace App\Controller\Back;

use App\Entity\Recipe;
use App\Form\RecipeType;
use App\Repository\RecipeRepository;
use App\Repository\ReviewRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class RecipeController extends AbstractController
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    // Affiche la liste des recettes dans l'interface d'administration
    #[Route('/admin/recipes', name: 'admin_recipes')]
    public function index(RecipeRepository $recipeRepository): Response
    {
        $recipes = $recipeRepository->findAll();
        return $this->render('admin/index.html.twig', [
            'recipes' => $recipes,
        ]);
    }

    // Affiche le formulaire de création d'une nouvelle recette dans l'interface d'administration
    #[Route('/admin/recipes/new', name: 'admin_recipes_new')]
    public function new(Request $request): Response
    {
        $recipe = new Recipe();
        $form = $this->createForm(RecipeType::class, $recipe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->persist($recipe);
            $this->entityManager->flush();

            return $this->redirectToRoute('admin_recipes');
        }

        return $this->render('admin/recipe/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    // Affiche le formulaire d'édition d'une recette dans l'interface d'administration
    #[Route('/admin/recipes/{id}/edit', name: 'admin_recipes_edit')]
    public function edit(Request $request, Recipe $recipe): Response
    {
        $form = $this->createForm(RecipeType::class, $recipe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->flush();

            return $this->redirectToRoute('admin_recipes');
        }

        return $this->render('admin/recipe/edit.html.twig', [
            'recipe' => $recipe,
            'form' => $form->createView(),
        ]);
    }

    // Affiche les détails d'une recette dans l'interface d'administration
    #[Route('/admin/recipes/{id}', name: 'admin_recipes_view', methods: ['GET'])]
    public function view(Recipe $recipe): Response
    {
        return $this->render('admin/recipe/view.html.twig', [
            'recipe' => $recipe,
        ]);
    }

    // Supprime une recette dans l'interface d'administration
    #[Route('/admin/recipes/{id}/delete', name: 'admin_recipes_delete', methods: ['POST'])]
    public function delete(Recipe $recipe): Response
    {
        $this->entityManager->remove($recipe);
        $this->entityManager->flush();

        return $this->redirectToRoute('admin_recipes');
    }

    #[Route('/admin/recipes/{id}/reviews', name: 'admin_recipes_reviews', methods: ['GET'])]
    public function showReviews(Recipe $recipe, ReviewRepository $reviewRepository): Response
    {
        // Récupérer les commentaires de la recette spécifique
        $reviews = $reviewRepository->findBy(['recipe' => $recipe]);

        return $this->render('admin/recipe/reviews.html.twig', [
            'recipe' => $recipe,
            'reviews' => $reviews,
        ]);
    }
}
