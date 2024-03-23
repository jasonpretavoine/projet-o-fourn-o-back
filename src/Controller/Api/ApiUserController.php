<?php

namespace App\Controller\Api;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;

class ApiUserController extends AbstractController
{

    private $JWTManager;
    private $entityManager;

    public function __construct(JWTTokenManagerInterface $JWTManager, EntityManagerInterface $entityManager)
    {
        $this->JWTManager = $JWTManager;
        $this->entityManager = $entityManager;
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
    
        // Validation des données
        $requiredFields = ['username', 'pseudo', 'password', 'email'];
        foreach ($requiredFields as $field) {
            if (!isset($data[$field])) {
                return $this->json(['error' => 'Données requises manquantes'], 400);
            }
        }
    
        // Création d'une nouvelle instance de User
        $user = new User();
        $user->setUsername($data['username']);
        $user->setPseudo($data['pseudo']);
        $user->setEmail($data['email']);
        $user->setRoles(['ROLE_USER']);
    
        // Hachage sécurisé du mot de passe et attribution à l'utilisateur
        $hashedPassword = $passwordHasher->hashPassword($user, $data['password']);
        $user->setPassword($hashedPassword);
    
        // Enregistrement de l'utilisateur en base de données
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
            'id' => $user->getId(),
            'username' => $user->getUsername(),
            'email' => $user->getEmail(),
            'pseudo' => $user->getPseudo(),
            'roles' => $user->getRoles(),
        ]);
    }

    #[Route('/api/users/{id}/edit', name: 'api_users_edit')]
    public function edit(Request $request, UserPasswordHasherInterface $passwordHasher, EntityManagerInterface $entityManager, SerializerInterface $serializer, User $user): Response
    {
        $form = $this->createForm(UserType::class, $user, ['csrf_protection' => false]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $newPassword = $form->get('password')->getData();

            if ($newPassword) {
                $user->setPassword($passwordHasher->hashPassword($user, $newPassword));
            }

            try {
                $entityManager->flush();
            } catch (\Throwable $th) {
                $this->addFlash('attention', 'Cette adresse mail existe déjà');
            }

            // Utilise le serializer pour sérialiser les données de l'utilisateur
            $serializedUser = $serializer->serialize($user, 'json', ['groups' => 'edit_users']);

            // Retourne une réponse JSON avec les données sérialisées
            return new JsonResponse($serializedUser, Response::HTTP_OK, [], true);
        }

        // // Remplace la valeur du champ de mot de passe par des étoiles
        // $formView->children['password']->vars['value'] = str_repeat('*', 8);

        return $this->json(['message' => 'Fonctionnalité en cours de développement']);
    }
    #[Route('/api/users/{id}', name: 'api_users_delete', methods: ['DELETE'])]
    public function delete(User $user, EntityManagerInterface $entityManager): Response
    {
        $entityManager->remove($user);
        $entityManager->flush();

        return $this->json(['message' => 'Utilisateur supprimé avec succès']);
    }
}
