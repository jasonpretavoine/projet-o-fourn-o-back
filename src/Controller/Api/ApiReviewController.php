<?php

namespace App\Controller\Api;

use App\Entity\Review;
use App\Repository\ReviewRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ApiReviewController extends AbstractController
{
    /**
     * Renvoi de la liste de tous les commentaires
     *
     * @param ReviewRepository $reviewRepository
     * @return JsonResponse
     * 
     * @Route("/api/reviews/view", name="api_reviews_view_get", methods={"GET"})  
     */
    #[Route('/api/reviews/view', name: 'api_reviews_view_get', methods: ['GET'])]
    public function getCollection(ReviewRepository $reviewRepository): JsonResponse
    {
        $reviews = $reviewRepository->findAll();
        return $this->json($reviews, 200, [],['groups' => 'get_reviews_collection']);
    } 

    /**
     * Renvoi un commentaire donnée
     *
     * @param ReviewRepository $reviewRepository
     * @return JsonResponse
     * 
     * @Route("/api/review/{id<\d+>}", name="api_review_get", methods={"GET"})  
     */
    #[Route('/api/review/{id<\d+>}', name: 'api_review_get', methods: ['GET'])]
    public function getItem(Review $review): JsonResponse
    {
        
        return $this->json($review, 200, [],['groups' => 'get_review_item']);
    }
}
