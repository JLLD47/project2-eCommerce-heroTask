<?php

namespace App\Controller;

use App\Entity\Achievements;
use App\Form\AchievementsType;
use App\Repository\AchievementsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/achievements')]
class AchievementsController extends AbstractController
{
    #[Route('/', name: 'app_achievements_index', methods: ['GET'])]
    public function index(AchievementsRepository $achievementsRepository): Response
    {
        return $this->render('achievements/index.html.twig', [
            'achievements' => $achievementsRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_achievements_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $achievement = new Achievements();
        $form = $this->createForm(AchievementsType::class, $achievement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($achievement);
            $entityManager->flush();

            return $this->redirectToRoute('app_achievements_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('achievements/new.html.twig', [
            'achievement' => $achievement,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_achievements_show', methods: ['GET'])]
    public function show(Achievements $achievement): Response
    {
        return $this->render('achievements/show.html.twig', [
            'achievement' => $achievement,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_achievements_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Achievements $achievement, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(AchievementsType::class, $achievement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_achievements_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('achievements/edit.html.twig', [
            'achievement' => $achievement,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_achievements_delete', methods: ['POST'])]
    public function delete(Request $request, Achievements $achievement, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$achievement->getId(), $request->request->get('_token'))) {
            $entityManager->remove($achievement);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_achievements_index', [], Response::HTTP_SEE_OTHER);
    }
}
