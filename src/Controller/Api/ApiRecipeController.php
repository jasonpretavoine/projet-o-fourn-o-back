<?php

namespace App\Controller\Api;

use App\Entity\Recipe;
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
     * @Route("/api/recipes/view", name="api_recipes_view_get", methods={"GET"})  
     */
    #[Route('/api/recipes/view', name: 'api_recipes_view_get', methods: ['GET'])]
    public function getCollection(RecipeRepository $recipeRepository): JsonResponse
    {
        $recipes = $recipeRepository->findAll();
        return $this->json($recipes, 200, [],['groups' => 'get_recipes_collection']);
    }   

      /**
     * Renvoi une recette donnée
     *
     * @param RecipeRepository $recipeRepository
     * @return JsonResponse
     * 
     * @Route("/api/recipe/{id<\d+>}", name="api_recipe_get", methods={"GET"})  
     */
    #[Route('/api/recipe/{id<\d+>}', name: 'api_recipe_get', methods: ['GET'])]
    public function getItem(Recipe $recipe): JsonResponse
    {
        
        return $this->json($recipe, 200, [],['groups' => 'get_recipe_item']);
    }
}
