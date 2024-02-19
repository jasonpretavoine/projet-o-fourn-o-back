<?php

namespace App\Controller\Back;

use App\Repository\CategoryRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CategoryController extends AbstractController
{
     // Affiche la liste de tous les ingrédients
     #[Route('/admin/categories', name: 'admin_categories_index', methods: ['GET'])]
     public function index(CategoryRepository $categoryRepository): Response
     {
         $categories = $categoryRepository->findAll();
         return $this->render('admin/category/index.html.twig', [
             'categories' => $categories,
         ]);
     }
 
    
}
