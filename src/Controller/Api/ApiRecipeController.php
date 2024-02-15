<?php

namespace App\Controller\Api;

use App\Entity\Recipe;
use App\Repository\RecipeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
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

     /**
     * Renvoi une liste de recettes aléatoires
     *
     * @param RecipeRepository $recipeRepository
     * @return JsonResponse
     * 
     * @Route("/api/recipes/random", name="api_recipes_random_get", methods={"GET"})  
     */
    #[Route('/api/recipes/random', name: 'api_recipes_random_get', methods: ['GET'])]
    public function getRandomRecipe(RecipeRepository $recipeRepository): JsonResponse
    {
        $recipes = $recipeRepository->findFiveRandom();
        return $this->json($recipes, 200, [],['groups' => 'get_recipes_random']);
    }


    /**
     * Met à jour une recette existante
     *
     * @param Request $request
     * @param Recipe $recipe
     * @param EntityManagerInterface $entityManager
     * @return JsonResponse
     * 
     * @Route("/api/recipe/{id<\d+>}", name="api_recipe_update_put", methods={"PUT"})
     */
    #[Route('/api/recipe/{id<\d+>}', name: 'api_recipe_update_put', methods: ['PUT'])]
    public function update(Request $request, Recipe $recipe, EntityManagerInterface $entityManager): JsonResponse
    {
        // Récupérer les données JSON envoyées dans la requête
        $data = json_decode($request->getContent(), true);

        // Vérifiez si les données requises sont présentes
        if (!isset($data['name']) || !isset($data['description'])) {
            return $this->json(['error' => 'Données requises manquantes'], 400);
        }

        // Mettez à jour les propriétés de la recette
        $recipe->setName($data['name']);
        $recipe->setDescription($data['description']);

        // Persistez les modifications dans la base de données
        $entityManager->flush();

        // Réponse JSON indiquant que la recette a été mise à jour avec succès
        return $this->json(['message' => 'Recette mise à jour avec succès'], 200);
    }
}
