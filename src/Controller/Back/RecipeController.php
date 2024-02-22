<?php

namespace App\Controller\Back;

use App\Entity\Recipe;
use App\Form\RecipeType;
use App\Repository\RecipeRepository;
use App\Repository\ReviewRepository;
use App\Repository\IngredientRepository;
use App\Repository\UstensilRepository;
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

    #[Route('/admin/recipes', name: 'admin_recipes')]
    public function index(RecipeRepository $recipeRepository): Response
    {
        $recipes = $recipeRepository->findAll();
        return $this->render('admin/index.html.twig', [
            'recipes' => $recipes,
        ]);
    }

    #[Route('/admin/recipes/new', name: 'admin_recipes_new')]
    public function new(Request $request, IngredientRepository $ingredientRepository, UstensilRepository $ustensilRepository): Response
    {
        $recipe = new Recipe();
        $form = $this->createForm(RecipeType::class, $recipe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Récupérer les données des ingrédients et des ustensiles sélectionnés dans le formulaire
            $ingredients = $form->get('ingredients')->getData();
            $ustensils = $form->get('ustensils')->getData();

            // Associer les ingrédients et les ustensiles à la recette
            foreach ($ingredients as $ingredient) {
                $recipe->addIngredient($ingredient);
            }
            foreach ($ustensils as $ustensil) {
                $recipe->addUstensil($ustensil);
            }

            $this->entityManager->persist($recipe);
            $this->entityManager->flush();

            return $this->redirectToRoute('admin_recipes');
        }

        return $this->render('admin/recipe/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/admin/recipes/{id}/edit', name: 'admin_recipes_edit')]
    public function edit(Request $request, Recipe $recipe, IngredientRepository $ingredientRepository, UstensilRepository $ustensilRepository): Response
    {
        $form = $this->createForm(RecipeType::class, $recipe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            
            // Récupérer les données des ingrédients et des ustensiles sélectionnés dans le formulaire
            $ingredients = $form->get('ingredients')->getData();
            $ustensils = $form->get('ustensils')->getData();

            // Supprimer les anciens ingrédients et ustensiles associés à la recette
            foreach ($recipe->getIngredients() as $ingredient) {
                $recipe->removeIngredient($ingredient);
            }
            foreach ($recipe->getUstensils() as $ustensil) {
                $recipe->removeUstensil($ustensil);
            }

            // Associer les nouveaux ingrédients et ustensiles à la recette
            foreach ($ingredients as $ingredient) {
                $recipe->addIngredient($ingredient);
            }
            foreach ($ustensils as $ustensil) {
                $recipe->addUstensil($ustensil);
            }

            $this->entityManager->flush();

            return $this->redirectToRoute('admin_recipes');
        }

        return $this->render('admin/recipe/edit.html.twig', [
            'recipe' => $recipe,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/admin/recipes/{id}', name: 'admin_recipes_view', methods: ['GET'])]
    public function view(Recipe $recipe): Response
    {
        return $this->render('admin/recipe/view.html.twig', [
            'recipe' => $recipe,
        ]);
    }

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
        $reviews = $reviewRepository->findBy(['recipe' => $recipe]);

        return $this->render('admin/recipe/reviews.html.twig', [
            'recipe' => $recipe,
            'reviews' => $reviews,
        ]);
    }
}
