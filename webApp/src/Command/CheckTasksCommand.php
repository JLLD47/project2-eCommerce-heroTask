<?php

namespace App\Command;

use App\Repository\TaskRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:check-tasks',
    description: 'Marks task as failed if they are older than 1 day',
)]
class CheckTasksCommand extends Command
{
    private EntityManagerInterface $entityManager;
    private TaskRepository $taskRepository;

    public function __construct(TaskRepository $taskRepository , EntityManagerInterface $entityManager)
    {
        parent::__construct();
        $this->taskRepository = $taskRepository;
        $this->entityManager = $entityManager;
    }

    protected function configure(): void
    {
        $this
            ->addArgument('arg1', InputArgument::OPTIONAL, 'Argument description')
            ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $now = new DateTime();
        $yesterday = $now->sub(new \DateInterval('P1D'));

        $tasks = $this->taskRepository->findFailedTasks($yesterday);

        foreach ($tasks as $task) {
            $task->setFailed(true);
            $entityManager = $this->entityManager;
            $entityManager->persist($task);
            $entityManager->flush();

    }
        return Command::SUCCESS;
}
}