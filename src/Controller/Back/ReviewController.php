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

    #[Route('/admin/reviews/{recipeId}', name: 'admin_reviews')]
    public function index(int $recipeId): Response
    {
        $reviews = $this->reviewRepository->findBy(['recipe' => $recipeId]);

        return $this->render('admin/review/index.html.twig', [
            'reviews' => $reviews,
        ]);
    }

    #[Route('/admin/review/{id}/edit', name: 'admin_review_edit')]
    public function edit(Request $request, Review $review): Response
    {
        $form = $this->createForm(ReviewStatusType::class, $review);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->flush();

            return $this->redirectToRoute('admin_reviews', ['recipeId' => $review->getRecipe()->getId()]);
        }

        return $this->render('admin/review/edit.html.twig', [
            'review' => $review,
            'form' => $form->createView(),
        ]);
    }
}
