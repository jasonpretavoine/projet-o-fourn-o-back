<?php

namespace App\Controller\Api;

use App\Repository\IngredientRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ApiIngredientController extends AbstractController
{
    /**
     * Renvoi de la liste de tous les ingredients
     *
     * @param IngredientRepository $ingredientRepository
     * @return JsonResponse
     * 
     * @Route("/api/ingredients/view", name="api_ingredients_view_get", methods={"GET"})
     */
    #[Route('/api/ingredients/view', name: 'api_ingredients_view_get', methods: ['GET'])]
    public function getCollection(IngredientRepository $ingredientRepository): JsonResponse
    {
        $ingredients = $ingredientRepository->findAll();
        return $this->json($ingredients, 200, [],['groups' => 'get_ingredients_collection']);
    } 
}
