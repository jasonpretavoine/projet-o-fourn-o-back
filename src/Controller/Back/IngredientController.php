<?php

namespace App\Controller\Back;

use App\Entity\Ingredient;
use App\Form\IngredientType;
use App\Repository\IngredientRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

class IngredientController extends AbstractController
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    // Affiche la liste de tous les ingrédients
    #[Route('/admin/ingredients', name: 'admin_ingredients_index', methods: ['GET'])]
    public function index(IngredientRepository $ingredientRepository): Response
    {
        $ingredients = $ingredientRepository->findAll();
        return $this->render('admin/ingredient/index.html.twig', [
            'ingredients' => $ingredients,
        ]);
    }

    // Affiche le formulaire pour créer un nouvel ingrédient
    #[Route('/admin/ingredients/new', name: 'admin_ingredients_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $ingredient = new Ingredient();
        $form = $this->createForm(IngredientType::class, $ingredient);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->persist($ingredient);
            $this->entityManager->flush();

            return $this->redirectToRoute('admin_ingredients_index');
        }

        return $this->render('admin/ingredient/new.html.twig', [
            'ingredient' => $ingredient,
            'form' => $form->createView(),
        ]);
    }

    // Affiche les détails d'un ingrédient
    #[Route('/admin/ingredients/{id}', name: 'admin_ingredients_view', methods: ['GET'])]
    public function view(Ingredient $ingredient): Response
    {
        return $this->render('admin/ingredient/view.html.twig', [
            'ingredient' => $ingredient,
        ]);
    }

    // Affiche le formulaire pour modifier un ingrédient existant
    #[Route('/admin/ingredients/{id}/edit', name: 'admin_ingredients_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Ingredient $ingredient): Response
    {
        $form = $this->createForm(IngredientType::class, $ingredient);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->flush();

            return $this->redirectToRoute('admin_ingredients_index');
        }

        return $this->render('admin/ingredient/edit.html.twig', [
            'ingredient' => $ingredient,
            'form' => $form->createView(),
        ]);
    }

    // Supprime un ingrédient
    #[Route('/admin/ingredients/{id}', name: 'admin_ingredients_delete', methods: ['POST'])]
    public function delete(Request $request, Ingredient $ingredient): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ingredient->getId(), $request->request->get('_token'))) {
            $this->entityManager->remove($ingredient);
            $this->entityManager->flush();
        }

        return $this->redirectToRoute('admin_ingredients_index');
    }
}
