<?php

namespace App\Controller\Back;

use App\Repository\RecipeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    private RecipeRepository $recipeRepository;

    public function __construct(RecipeRepository $recipeRepository)
    {
        $this->recipeRepository = $recipeRepository;
    }

    #[Route('/', name: 'app_admin')]
    public function index(): Response
    {
      
        $recipes = $this->recipeRepository->findAll();

       
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
            'recipes' => $recipes,
        ]);
    }
}
