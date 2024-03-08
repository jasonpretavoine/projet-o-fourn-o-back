<?php

namespace App\Controller\Api;

use App\Entity\Recipe;
use App\Entity\Review;
use App\Repository\UserRepository;
use App\Repository\ReviewRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
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
        return $this->json($reviews, 200, [], ['groups' => 'get_reviews_collection']);
    }

    /**
     * Renvoi un commentaire donné
     *
     * @param ReviewRepository $reviewRepository
     * @return JsonResponse
     * 
     * @Route("/api/review/{id<\d+>}", name="api_review_get", methods={"GET"})  
     */
    #[Route('/api/review/{id<\d+>}', name: 'api_review_get', methods: ['GET'])]
    public function getItem(Review $review): JsonResponse
    {

        return $this->json($review, 200, [], ['groups' => 'get_review_item']);
    }

    /**
     * Met à jour un commentaire existant
     *
     * @param Request $request
     * @param Review $review
     * @param EntityManagerInterface $entityManager
     * @return JsonResponse
     * 
     * @Route("/api/review/{id<\d+>}", name="api_review_update_put", methods={"PUT"})
     */
    #[Route('/api/review/{id<\d+>}/update', name: 'api_review_update_put', methods: ['PUT'])]
    public function update(Request $request, Review $review, EntityManagerInterface $entityManager): JsonResponse
    {
        // Récupérer les données JSON envoyées dans la requête
        $data = json_decode($request->getContent(), true);

        // Vérifiez si les données requises sont présentes
        if (!isset($data['text']) || !isset($data['rating'])) {
            return $this->json(['error' => 'Données requises manquantes'], 400);
        }

        // Mettez à jour les propriétés du commentaire
        $review->setText($data['text']);
        $review->setRating($data['rating']);
        // Mettez à jour d'autres propriétés si nécessaire...

        // Persistez les modifications dans la base de données
        $entityManager->flush();

        // Réponse JSON indiquant que le commentaire a été mis à jour avec succès
        return $this->json(['message' => 'Commentaire mis à jour avec succès'], 200);
    }

    /**
     * Crée un nouveau commentaire
     *
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @return JsonResponse
     * 
     * @Route("/api/review/create", name="api_review_create_post", methods={"POST"})
     */
    #[Route('/api/recipes/{id}/review/create', name: 'api_review_create_post', methods: ['POST'])]
    public function create(Recipe $recipe, Request $request, EntityManagerInterface $entityManager, UserRepository $userRepository): JsonResponse
    {
         $user = $this->getUser();
        
        $user = $userRepository->find(3);
        // Récupérer les données JSON envoyées dans la requête
        $data = json_decode($request->getContent(), true);

        // Vérifiez si les données requises sont présentes
    if (!isset($data['text'], $data['rating'], $data['user_id'])) {
            return $this->json(['error' => 'Données requises manquantes'], 400);
        }
  $user = $userRepository->find($data['user_id']);
    if (!$user) {
        return $this->json(['error' => 'Utilisateur non trouvé'], 404);
    }
        // Créez une nouvelle instance de l'entité Review
        $review = new Review();
        $review->setText($data['text']);
        $review->setRating($data['rating']);
        $review->setUser($user);
        $review->setRecipe($recipe);
        // Initialisez d'autres propriétés si nécessaire...

        // Persistez le nouveau commentaire dans la base de données
        $entityManager->persist($review);
        $entityManager->flush();

        // Réponse JSON indiquant que le commentaire a été créé avec succès
        return $this->json(['message' => 'Commentaire créé avec succès'], 201);
    }

    #[Route('/api/recipes/{id}/review/count', name: 'api_review_count_get', methods: ['GET'])]
    public function countReviews(Recipe $recipe): JsonResponse
    {
        $reviewsCount = count($recipe->getReviews());

        return $this->json(['count' => $reviewsCount]);
    }
}
