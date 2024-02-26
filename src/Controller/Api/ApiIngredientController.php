<?php

namespace App\Controller\Api;

use App\Entity\Ingredient;
use App\Repository\IngredientRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ApiIngredientController extends AbstractController
{
    /**
     * Renvoi de la liste de tous les ingrédients
     *
     * @param IngredientRepository $ingredientRepository
     * @return JsonResponse
     * 
     * @Route("/api/ingrédients/view", name="api_ingredients_view_get", methods={"GET"})
     */
    #[Route('/api/ingredients/view', name: 'api_ingredients_view_get', methods: ['GET'])]
    public function getCollection(IngredientRepository $ingredientRepository): JsonResponse
    {
        // Récupère tous les ingrédients
        $ingredients = $ingredientRepository->findAll();
        // Retourne les ingrédients au format JSON avec le code de statut 200
        return $this->json($ingredients, 200, [],['groups' => 'get_ingredients_collection']);
    } 

    /**
     * Renvoi un ingrédient donnée
     *
     * @param IngredientRepository $ingredientRepository
     * @return JsonResponse
     * 
     * @Route("/api/ingredient/{id<\d+>}", name="api_ingredient_get", methods={"GET"})  
     */
    #[Route('/api/ingredient/{id<\d+>}', name: 'api_ingredient_get', methods: ['GET'])]
    public function getItem(Ingredient $ingredient): JsonResponse
    {
        // Retourne l'ingrédient spécifié au format JSON avec le code de statut 200
        return $this->json($ingredient, 200, [],['groups' => 'get_ingredient_item']);
    }
}
