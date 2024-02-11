<?php

namespace App\Controller\Api;

use App\Repository\UstensilRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ApiUstensilController extends AbstractController
{
   /**
     * Renvoi de la liste de tous les ustensiles
     *
     * @param UstensilRepository $ustensilRepository
     * @return JsonResponse
     * 
     * @Route("/api/ustensils/view", name="api_ustensil_view_get", methods={"GET"})  
     */
    #[Route('/api/ustensils/view', name: 'api_ustensils_view_get', methods: ['GET'])]
    public function getCollection(UstensilRepository $ustensilRepository): JsonResponse
    {
        $ustensils = $ustensilRepository->findAll();
        return $this->json($ustensils, 200, [],['groups' => 'get_ustensils_collection']);
    } 
}
