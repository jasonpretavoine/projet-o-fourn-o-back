<?php

namespace App\Controller\Back;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use App\Repository\RecipeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserController extends AbstractController
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    // Affiche la liste des utilisateurs
    #[Route('/admin/users', name: 'admin_users')]
    public function index(UserRepository $userRepository): Response
    {
        $users = $userRepository->findAll();
        return $this->render('admin/user/index.html.twig', [
            'users' => $users,
        ]);
    }

    // Crée un nouvel utilisateur
    #[Route('/admin/users/new', name: 'admin_users_new')]
    public function new(Request $request, UserPasswordHasherInterface $passwordHasher): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user->setPassword($passwordHasher->hashPassword($user, $user->getPassword()));
            $this->entityManager->persist($user);
            $this->entityManager->flush();

            return $this->redirectToRoute('admin_users');
        }

        return $this->render('admin/user/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    // Modifie un utilisateur existant
    #[Route('/admin/users/{id}/edit', name: 'admin_users_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, UserPasswordHasherInterface $passwordHasher, EntityManagerInterface $entityManager, User $user): Response
    {
        $form = $this->createForm(UserType::class, $user);
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

            return $this->redirectToRoute('admin_users');
        }

        // Remplace la valeur du champ de mot de passe par des étoiles
        $formView = $form->createView();
        $formView->children['password']->vars['value'] = str_repeat('*', 8);
        return $this->render('admin/user/edit.html.twig', [
            'user' => $user,
            'form' => $formView,
        ]);
    }

    // Affiche les détails d'un utilisateur
    #[Route('/admin/users/{id}', name: 'admin_users_view', methods: ['GET'])]
    public function view(User $user): Response
    {
        return $this->render('admin/user/view.html.twig', [
            'user' => $user,
        ]);
    }

    // Supprime un utilisateur
    #[Route('/admin/users/{id}/delete', name: 'admin_users_delete', methods: ['POST'])]
    public function delete(User $user, EntityManagerInterface $entityManager, RecipeRepository $recipeRepository): RedirectResponse
    {
        $adminUser = $entityManager->getRepository(User::class)->findOneBy(['email' => 'admin@admin.com']);

        if (!$adminUser) {

            throw $this->createNotFoundException('Administrateur non trouvé.');
        }

        // Récupérer les recettes de l'utilisateur en cours de suppression
        $recipes = $recipeRepository->findBy(['user' => $user]);

        foreach ($recipes as $recipe) {
            // Modifier l'utilisateur de chaque recette pour le définir sur l'utilisateur admin
            $recipe->setUser($adminUser);
        }

        $entityManager->remove($user);
        $entityManager->flush();

        return $this->redirectToRoute('admin_users');
    }
}
