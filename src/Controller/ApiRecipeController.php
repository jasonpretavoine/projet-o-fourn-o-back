<?php

namespace App\Controller;

use App\Repository\RecipeRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ApiRecipeController extends AbstractController
{
    /**
     * Renvoi de la liste de toutes les recettes
     *
     * @param RecipeRepository $recipeRepository
     * @return JsonResponse
     * 
     * @Route("/api/recipes", name="api_recipes_get", methods={"GET"})
     */
    public function getCollection(RecipeRepository $recipeRepository): JsonResponse
    {
        $recipes = $recipeRepository->findAll();
        return $this->json($recipes, 200, []);
    }

     
      /**
     * 
     * 
     * @return Response 
     */
    #[Route('/api/recipes/view', name: 'app_api_recipes_view', methods: ['GET'])]
    public function viewRecipes(RecipeRepository $recipeRepository): Response
    {
        $recipes = $recipeRepository->findAll();
        return $this->render('api_recipe/index.html.twig', [
            'recipes' => $recipes,
        ]);
    }
    
}
