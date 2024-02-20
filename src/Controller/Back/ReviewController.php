<?php

namespace App\Controller\Back;

use App\Entity\Review;
use App\Form\ReviewStatusType;
use App\Repository\ReviewRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReviewController extends AbstractController
{
    private EntityManagerInterface $entityManager;
    private ReviewRepository $reviewRepository;

    public function __construct(EntityManagerInterface $entityManager, ReviewRepository $reviewRepository)
    {
        $this->entityManager = $entityManager;
        $this->reviewRepository = $reviewRepository;
    }


    #[Route('/admin/review/{id}/edit', name: 'admin_review_edit')]
    public function edit(Request $request, Review $review): Response
    {
        $form = $this->createForm(ReviewStatusType::class, $review);
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->flush();
    
            // Récupérer l'identifiant de la recette associée au commentaire modifié
            $recipeId = $review->getRecipe()->getId();
    
            return $this->redirectToRoute('admin_recipes_reviews', ['id' => $recipeId]);
        }
    
        return $this->render('admin/review/edit.html.twig', [
            'review' => $review,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/admin/review/{id}/delete', name: 'admin_review_delete', methods: ['POST'])]
    public function delete(Request $request, Review $review, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$review->getId(), $request->request->get('_token'))) {
            $entityManager->remove($review);
            $entityManager->flush();
        }
    
        // Redirection vers la page précédente après la suppression
        return $this->redirectToRoute('admin_recipes_reviews', ['id' => $review->getRecipe()->getId()]);
    }
}
