<?php

namespace App\Controller\Api;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ApiUserController extends AbstractController
{
    /**
     * Renvoi de la liste de tous les utilisateurs
     *
     * @param UserRepository $userRepository
     * @return JsonResponse
     * 
     * @Route("/api/users/view", name="api_users_view_get", methods={"GET"})  
     */
    #[Route('/api/users/view', name: 'api_users_view_get', methods: ['GET'])]
    public function getCollection(UserRepository $userRepository): JsonResponse
    {
        $users = $userRepository->findAll();
        return $this->json($users, 200, [],['groups' => 'get_users_collection']);
    } 

    /**
     * Renvoi un utilisateur donnée
     *
     * @param UserRepository $userRepository
     * @return JsonResponse
     * 
     * @Route("/api/user/{id<\d+>}", name="api_user_get", methods={"GET"})  
     */
    #[Route('/api/user/{id<\d+>}', name: 'api_user_get', methods: ['GET'])]
    public function getItem(User $user): JsonResponse
    {
        
        return $this->json($user, 200, [],['groups' => 'get_user_item']);
    }
}
