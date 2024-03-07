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
        return $this->json($recipes, 200, [], ['groups' => 'get_recipes_collection']);
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

        return $this->json($recipe, 200, [], ['groups' => 'get_recipe_item']);
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
        return $this->json($recipes, 200, [], ['groups' => 'get_recipes_random']);
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
    #[Route('/api/recipe/{id<\d+>}/update', name: 'api_recipe_update_put', methods: ['PUT'])]
    public function update(Request $request, Recipe $recipe, EntityManagerInterface $entityManager): JsonResponse
    {
        // Récupérer les données JSON envoyées dans la requête
        $data = json_decode($request->getContent(), true);

        // Vérifiez si les données requises sont présentes
        if (!isset($data['name']) || !isset($data['description']) || !isset($data['instructions']) || !isset($data['difficulty']) || !isset($data['preparationTime']) || !isset($data['cookingTime']) || !isset($data['servings'])) {
            return $this->json(['error' => 'Données requises manquantes'], 400);
        }

        // Mettez à jour les propriétés de la recette
        $recipe->setName($data['name']);
        $recipe->setDescription($data['description']);
        $recipe->setInstructions($data['instructions']);
        $recipe->setDifficulty($data['difficulty']);
        $recipe->setPreparationTime($data['preparationTime']);
        $recipe->setCookingTime($data['cookingTime']);
        $recipe->setServings($data['servings']);

        // Persistez les modifications dans la base de données
        $entityManager->flush();

        // Réponse JSON indiquant que la recette a été mise à jour avec succès
        return $this->json(['message' => 'Recette mise à jour avec succès'], 200);
    }

    /**
     * Crée une nouvelle recette
     *
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @return JsonResponse
     * 
     * @Route("/api/recipe/create", name="api_recipe_create_post", methods={"POST"})
     */
    #[Route('/api/recipe/create', name: 'api_recipe_create_post', methods: ['POST'])]
    public function create(Request $request, EntityManagerInterface $entityManager): JsonResponse
    {
        // Récupérer les données JSON envoyées dans la requête
        $data = json_decode($request->getContent(), true);

        // Vérifiez si les données requises sont présentes
        if (!isset($data['name']) || !isset($data['description']) || !isset($data['instructions']) || !isset($data['difficulty']) || !isset($data['preparationTime']) || !isset($data['cookingTime']) || !isset($data['servings'])) {
            return $this->json(['error' => 'Données requises manquantes'], 400);
        }

        // Créez une nouvelle instance de l'entité Recipe
        $recipe = new Recipe();
        $recipe->setName($data['name']);
        $recipe->setDescription($data['description']);
        $recipe->setInstructions($data['instructions']);
        $recipe->setDifficulty($data['difficulty']);
        $recipe->setPreparationTime($data['preparationTime']);
        $recipe->setCookingTime($data['cookingTime']);
        $recipe->setServings($data['servings']);

        // Persistez la nouvelle recette dans la base de données
        $entityManager->persist($recipe);
        $entityManager->flush();

        // Réponse JSON indiquant que la recette a été créée avec succès
        return $this->json(['message' => 'Recette créée avec succès'], 201);
    }
}
