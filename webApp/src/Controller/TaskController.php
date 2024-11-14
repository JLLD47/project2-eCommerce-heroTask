<?php

namespace App\Controller;

use App\Entity\Task;
use App\Entity\User;
use App\Form\TaskType;
use App\Repository\TaskRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/task')]
class TaskController extends AbstractController
{
    #[Route('/', name: 'app_task_index', methods: ['GET'])]
    public function index(TaskRepository $taskRepository): Response
    {
        return $this->render('task/index.html.twig', [
            'tasks' => $taskRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_task_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $task = new Task();
        $form = $this->createForm(TaskType::class, $task);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if ($task->getDifficulty() === 1) {
                $task->setXpReward(15);
            } elseif ($task->getDifficulty() === 2) {
                $task->setXpReward(25);
            } else {
                $task->setXpReward(40);
            }

            $task->setUser($this->getUser());
            $entityManager->persist($task);
            $entityManager->flush();

            return $this->redirectToRoute('app_user_show', ['id' => $task->getUser()->getId()]);
        }

        return $this->render('task/new.html.twig', [
            'task' => $task,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_task_show', methods: ['GET'])]
    public function show(Task $task): Response
    {
        return $this->render('task/show.html.twig', [
            'task' => $task,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_task_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Task $task, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(TaskType::class, $task);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $task->setUser($this->getUser());
            $entityManager->flush();

            return $this->redirectToRoute('app_user_show', ['id' => $task->getUser()->getId()]);
        }

        return $this->render('task/edit.html.twig', [
            'task' => $task,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_task_delete', methods: ['POST'])]
    public function delete(Request $request, Task $task, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $task->getId(), $request->request->get('_token'))) {
            $entityManager->remove($task);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_task_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/user/tasks/{id}', name: 'get_user_tasks', methods: ['GET'])]
    public function getUserTasks(TaskRepository $taskRepository, $id): Response
    {
        $tasks = $taskRepository->findByUserId($id);
        return $this->render('task/user_tasks.html.twig', ['userTasks' => $tasks]);
    }

    #[Route('/taskdone/{id}', name: 'task_done', methods: ['PATCH', 'POST'])]
    public function taskDone($id, TaskRepository $taskRepository, EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();
        $task = $taskRepository->find($id);

        $task->setCompleted(true);

        $taskType = $task->getType();
        /* @var $user User */
        switch ($taskType) {
            case 'Strength':
                $user->setStrCurrent($user->getStrCurrent() + $task->getXpReward());
                if ($user->getStrCurrent() > $user->getStrXpRq()) {
                    $user->setStrength($user->getStrength() + 1);
                    $user->setStrCurrent($user->getStrCurrent() - $user->getStrXpRq());
                    $user->setStrXpRq($user->getStrXpRq() * ($user->getStrength() * 0.5));
                    $user->setCurrentXp($user->getCurrentXp() + 33);
                }
                break;
            case 'Intelligence':
                $user->setIntCurrent($user->getIntCurrent() + $task->getXpReward());
                if ($user->getIntCurrent() > $user->getIntXpRq()) {
                    $user->setIntelligence($user->getIntelligence() + 1);
                    $user->setIntCurrent($user->getIntCurrent() - $user->getIntXpRq());
                    $user->setIntXpRq($user->getIntXpRq() * $user->getIntelligence() * 0.5);
                    $user->setCurrentXp($user->getCurrentXp() + 33);

                }
                break;
            case 'Constitution':
                $user->setConstCurrent($user->getConstCurrent() + $task->getXpReward());
                if ($user->getConstCurrent() > $user->getConstXpRq()) {
                    $user->setConstitution($user->getConstitution() + 1);
                    $user->setConstCurrent($user->getConstCurrent() - $user->getConstXpRq());
                    $user->setConstXpRq($user->getConstXpRq() * $user->getConstitution() * 0.5);
                    $user->setCurrentXp($user->getCurrentXp() + 33);

                }
                break;
            case 'Charisma':
                $user->setChaCurrent($user->getChaCurrent() + $task->getXpReward());
                if ($user->getChaCurrent() > $user->getChaXpRq()) {
                    $user->setCharisma($user->getCharisma() + 1);
                    $user->setChaCurrent($user->getChaCurrent() - $user->getChaXpRq());
                    $user->setChaXpRq($user->getChaXpRq() * $user->getStrength() * 0.5);
                    $user->setCurrentXp($user->getCurrentXp() + 33);

                }
                break;
        }
        if ($user->getCurrentXp() > $user->getXpRequired()) {
            $user->setCurrentLevel($user->getCurrentLevel() + 1);
            $user->setCurrentXp($user->getCurrentXp() - $user->getXpRequired());
        }

        $entityManager->flush();

        return $this->redirectToRoute('app_user_show', ['id' => $task->getUser()->getId()]);
    }


}



