<?php

namespace App\Controller\Api;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
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
        return $this->json($users, 200, [], ['groups' => 'get_users_collection']);
    }

    /**
     * Renvoi un utilisateur donné
     *
     * @param UserRepository $userRepository
     * @return JsonResponse
     * 
     * @Route("/api/user/{id<\d+>}", name="api_user_get", methods={"GET"})  
     */
    #[Route('/api/user/{id<\d+>}', name: 'api_user_get', methods: ['GET'])]
    public function getItem(User $user): JsonResponse
    {

        return $this->json($user, 200, [], ['groups' => 'get_user_item']);
    }

    /**
     * Crée un nouvel utilisateur
     *
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @return JsonResponse
     * 
     * @Route("/api/user/create", name="api_user_create_post", methods={"POST"})
     */
    #[Route('/api/user/create', name: 'api_user_create_post', methods: ['POST'])]
    public function create(Request $request, EntityManagerInterface $entityManager): JsonResponse
    {
        // Récupérer les données JSON envoyées dans la requête
        $data = json_decode($request->getContent(), true);

        // Vérifiez si les données requises sont présentes
        if (!isset($data['username']) || !isset($data['pseudo']) || !isset($data['password']) || !isset($data['email']) || !isset($data['role'])) {
            return $this->json(['error' => 'Données requises manquantes'], 400);
        }

        // Créez une nouvelle instance de l'entité User
        $user = new User();
        $user->setUsername($data['username']);
        $user->setPseudo($data['pseudo']);
        $user->setPassword($data['password']);
        $user->setEmail($data['email']);
        $user->setRole($data['role']);

        // Persistez l'utilisateur dans la base de données
        $entityManager->persist($user);
        $entityManager->flush();

        // Réponse JSON indiquant que l'utilisateur a été créé avec succès
        return $this->json(['message' => 'Utilisateur créé avec succès'], 201);
    }
}
