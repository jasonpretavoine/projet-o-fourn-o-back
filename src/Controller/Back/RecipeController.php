<?php

namespace App\Controller\Back;

use App\Entity\Recipe;
use App\Form\RecipeType;
use App\Repository\RecipeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RecipeController extends AbstractController
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/admin/recipes', name: 'admin_recipes')]
    public function index(RecipeRepository $recipeRepository): Response
    {
        $recipes = $recipeRepository->findAll();
        return $this->render('admin/index.html.twig', [
            'recipes' => $recipes,
        ]);
    }

    #[Route('/admin/recipes/new', name: 'admin_recipes_new')]
    public function new(Request $request): Response
    {
        $recipe = new Recipe();
        $form = $this->createForm(RecipeType::class, $recipe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->persist($recipe);
            $this->entityManager->flush();

            return $this->redirectToRoute('admin_recipes');
        }

        return $this->render('admin/recipe/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/admin/recipes/{id}/edit', name: 'admin_recipes_edit')]
    public function edit(Request $request, Recipe $recipe): Response
    {
        $form = $this->createForm(RecipeType::class, $recipe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->flush();

            return $this->redirectToRoute('admin_recipes');
        }

        return $this->render('admin/recipe/edit.html.twig', [
            'recipe' => $recipe,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/admin/recipes/{id}', name: 'admin_recipes_view', methods: ['GET'])]
    public function view(Recipe $recipe): Response
    {
        return $this->render('admin/recipe/view.html.twig', [
            'recipe' => $recipe,
        ]);
    }

    #[Route('/admin/recipes/{id}', name: 'admin_recipes_delete', methods: ['POST'])]
    public function delete(Recipe $recipe): Response
    {
        $this->entityManager->remove($recipe);
        $this->entityManager->flush();

        return $this->redirectToRoute('admin_recipes');
    }
}
