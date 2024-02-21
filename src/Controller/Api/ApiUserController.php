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
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;

class ApiUserController extends AbstractController
{

    private $JWTManager;

    public function __construct(JWTTokenManagerInterface $JWTManager)
    {
        $this->JWTManager = $JWTManager;
    }

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
    public function create(Request $request, EntityManagerInterface $entityManager, UserPasswordHasherInterface $passwordHasher): JsonResponse
    {

        $data = json_decode($request->getContent(), true);

        if (!isset($data['username']) || !isset($data['pseudo']) || !isset($data['password']) || !isset($data['email'])) {
            return $this->json(['error' => 'Données requises manquantes'], 400);
        }

        $user = new User();
        $user->setUsername($data['username']);
        $user->setPseudo($data['pseudo']);
        $user->setPassword($data['password']);
        $user->setPassword($passwordHasher->hashPassword($user, $user->getPassword()));
        $user->setEmail($data['email']);
        $user->setRoles(['ROLE_USER']);

        $entityManager->persist($user);
        $entityManager->flush();

        return $this->json(['message' => 'Utilisateur créé avec succès'], 201);
    }

    #[Route('/api/user/login', name: 'api_user_login', methods: ['POST'])]
    public function loginCheck(Request $request, UserRepository $userRepository, UserPasswordHasherInterface $passwordHasher): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $user = $userRepository->findOneBy(['email' => $data['email']]);

        if (!$user || !$passwordHasher->isPasswordValid($user, $data['password'])) {
            return new JsonResponse(['message' => 'Identifiants incorrects'], 401);
        }

        $token = $this->JWTManager->create($user);

        return new JsonResponse([
            'token' => $token,
            'username' => $user->getUsername(),
            'email' => $user->getEmail(),
            'pseudo' => $user->getPseudo(),
        ]);
    }
}
