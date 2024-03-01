<?php

namespace App\Controller\Back;

use App\Entity\Ustensil;
use App\Form\UstensilType;
use App\Repository\UstensilRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

class UstensilController extends AbstractController
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    // Affiche la liste des ustensiles
    #[Route('/admin/ustensils', name: 'admin_ustensils_index', methods: ['GET', 'POST'])]
    public function index(UstensilRepository $ustensilRepository): Response
    {
        $ustensils = $ustensilRepository->findAll();
        return $this->render('admin/ustensil/index.html.twig', [
            'ustensils' => $ustensils,
        ]);
    }

    // Crée un nouvel ustensile
    #[Route('/admin/ustensils/new', name: 'admin_ustensils_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $ustensil = new Ustensil();
        $form = $this->createForm(UstensilType::class, $ustensil);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->persist($ustensil);
            $this->entityManager->flush();

            return $this->redirectToRoute('admin_ustensils_index');
        }

        return $this->render('admin/ustensil/new.html.twig', [
            'ustensil' => $ustensil,
            'form' => $form->createView(),
        ]);
    }

    // Affiche les détails d'un ustensile
    #[Route('/admin/ustensils/{id}', name: 'admin_ustensils_view', methods: ['GET'])]
    public function view(Ustensil $ustensil): Response
    {
        return $this->render('admin/ustensil/view.html.twig', [
            'ustensil' => $ustensil,
        ]);
    }

    // Modifie un ustensile existant
    #[Route('/admin/ustensils/{id}/edit', name: 'admin_ustensils_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Ustensil $ustensil): Response
    {
        $form = $this->createForm(UstensilType::class, $ustensil);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->flush();

            return $this->redirectToRoute('admin_ustensils_index');
        }

        return $this->render('admin/ustensil/edit.html.twig', [
            'ustensil' => $ustensil,
            'form' => $form->createView(),
        ]);
    }

    // Supprime un ustensile
    #[Route('/admin/ustensils/{id}', name: 'admin_ustensils_delete', methods: ['POST'])]
    public function delete(Request $request, Ustensil $ustensil): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ustensil->getId(), $request->request->get('_token'))) {
            $this->entityManager->remove($ustensil);
            $this->entityManager->flush();
        }

        return $this->redirectToRoute('admin_ustensils_index');
    }
}
