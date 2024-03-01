<?php

namespace App\Controller\Back;

use App\Entity\Category;
use App\Form\CategoryType;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CategoryController extends AbstractController
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    
     // Affiche la liste de toutes les catégories
     #[Route('/admin/categories', name: 'admin_categories_index', methods: ['GET', 'POST'])]
     public function index(CategoryRepository $categoryRepository): Response
     {
         $categories = $categoryRepository->findAll();
         return $this->render('admin/category/index.html.twig', [
             'categories' => $categories,
         ]);
     }
 
    // Affiche le formulaire pour créer une nouvelle catégorie
     #[Route('/admin/categories/new', name: 'admin_categories_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $category = new Category();
        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->persist($category);
            $this->entityManager->flush();

            return $this->redirectToRoute('admin_categories_index');
        }

        return $this->render('admin/category/new.html.twig', [
            'category' => $category,
            'form' => $form->createView(),
        ]);
    }

    // Affiche les détails d'une catégorie
    #[Route('/admin/categories/{id}', name: 'admin_categories_view', methods: ['GET'])]
    public function view(Category $category): Response
    {
        return $this->render('admin/category/view.html.twig', [
            'category' => $category,
        ]);
    }

    // Affiche le formulaire pour modifier une catégorie existante
    #[Route('/admin/categories/{id}/edit', name: 'admin_categories_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Category $category): Response
    {
        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->flush();

            return $this->redirectToRoute('admin_categories_index');
        }

        return $this->render('admin/category/edit.html.twig', [
            'category' => $category,
            'form' => $form->createView(),
        ]);
    }

    // Supprime une catégorie
    #[Route('/admin/categories/{id}', name: 'admin_categories_delete', methods: ['POST'])]
    public function delete(Request $request, Category $category): Response
    {
        if ($this->isCsrfTokenValid('delete'.$category->getId(), $request->request->get('_token'))) {
            $this->entityManager->remove($category);
            $this->entityManager->flush();
        }

        return $this->redirectToRoute('admin_categories_index');
    }
}
