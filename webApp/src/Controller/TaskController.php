<?php

namespace App\Controller;

use App\Entity\Achievements;
use App\Entity\Task;
use App\Entity\User;
use App\Form\TaskType;
use App\Repository\TaskRepository;
use App\Repository\UserRepository;
use App\Service\TaskManager;
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
    public function taskDone($id, TaskRepository $taskRepository, EntityManagerInterface $entityManager, TaskManager $taskManager, UserRepository $userRepository): Response
    {
        $userId = $this->getUser()->getId();
        $user = $userRepository->find($userId);
        $task = $taskRepository->find($id);
        $taskManager->questDone($user, $task);


        $entityManager->flush();

        return $this->redirectToRoute('app_user_show', ['id' => $task->getUser()->getId()]);
    }


}



