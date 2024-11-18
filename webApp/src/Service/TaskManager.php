<?php

namespace App\Service;

use App\Entity\Achievements;
use App\Entity\Task;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;

class TaskManager
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function checkLvlStat(User $user, Task $task): void
    {
        $task->setCompleted(true);

        switch ($task->getType()) {
            case 'Strength':
                $user->setStrCurrent($user->getStrCurrent() + $task->getXpReward());
                if ($user->getStrCurrent() >= $user->getStrXpRq()) {
                    $user->setStrength($user->getStrength() + 1);
                    $user->setStrCurrent($user->getStrCurrent() - $user->getStrXpRq());
                    $user->setStrXpRq($user->getStrXpRq() * ($user->getStrength() * 0.5));
                    $user->setCurrentXp($user->getCurrentXp() + 33);
                }
                break;
            case 'Intelligence':
                $user->setIntCurrent($user->getIntCurrent() + $task->getXpReward());
                if ($user->getIntCurrent() >= $user->getIntXpRq()) {
                    $user->setIntelligence($user->getIntelligence() + 1);
                    $user->setIntCurrent($user->getIntCurrent() - $user->getIntXpRq());
                    $user->setIntXpRq($user->getIntXpRq() * $user->getIntelligence() * 0.5);
                    $user->setCurrentXp($user->getCurrentXp() + 33);
                }
                break;
            case 'Constitution':
                $user->setConstCurrent($user->getConstCurrent() + $task->getXpReward());
                if ($user->getConstCurrent() >= $user->getConstXpRq()) {
                    $user->setConstitution($user->getConstitution() + 1);
                    $user->setConstCurrent($user->getConstCurrent() - $user->getConstXpRq());
                    $user->setConstXpRq($user->getConstXpRq() * $user->getConstitution() * 0.5);
                    $user->setCurrentXp($user->getCurrentXp() + 33);
                }
                break;
            case 'Charisma':
                $user->setChaCurrent($user->getChaCurrent() + $task->getXpReward());
                if ($user->getChaCurrent() >= $user->getChaXpRq()) {
                    $user->setCharisma($user->getCharisma() + 1);
                    $user->setChaCurrent($user->getChaCurrent() - $user->getChaXpRq());
                    $user->setChaXpRq($user->getChaXpRq() * $user->getCharisma() * 0.5);
                    $user->setCurrentXp($user->getCurrentXp() + 33);
                }
                break;
        }
    }

    public function levelAchievements(User $user): void
    {
        if ($user->getCurrentXp() > $user->getXpRequired()) {
            $user->setCurrentLevel($user->getCurrentLevel() + 1);
            $user->setCurrentXp($user->getCurrentXp() - 100);

            $achievementRepo = $this->entityManager->getRepository(Achievements::class);
            $levelAchievements = [
                5 => 3,
                15 => 4,
                30 => 5,
                50 => 6,
            ];

            if (array_key_exists($user->getCurrentLevel(), $levelAchievements)) {
                $achievement = $achievementRepo->find($levelAchievements[$user->getCurrentLevel()]);
                $user->addAchievement($achievement);
            }
        }
    }

    public function attributeAchievements(User $user): void
    {
        $achievementRepo = $this->entityManager->getRepository(Achievements::class);
        $strengthAchievements = [
            10 => 7,
            25 => 8,
            50 => 9,
            100 => 10,
        ];
        $intelligenceAchievements = [
            10 => 11,
            25 => 12,
            50 => 13,
            100 => 14,
        ];
        $constitutionAchievements = [
            10 => 19,
            25 => 20,
            50 => 21,
            100 => 22,
        ];
        $charismaAchievements = [
            10 => 15,
            25 => 16,
            50 => 17,
            100 => 18,
        ];
        if ($user->getStrength() === $strengthAchievements) {
            if (array_key_exists($user->getStrength(), $strengthAchievements)) {
                $achievement = $achievementRepo->find($strengthAchievements[$user->getStrength()]);
                $user->addAchievement($achievement);

            }

        }
        if ($user->getIntelligence() === $intelligenceAchievements) {
            if (array_key_exists($user->getIntelligence(), $intelligenceAchievements)) {
                $achievement = $achievementRepo->find($intelligenceAchievements[$user->getIntelligence()]);
                $user->addAchievement($achievement);

            }

        }
        if ($user->getConstitution() === $constitutionAchievements) {
            if (array_key_exists($user->getConstitution(), $constitutionAchievements)) {
                $achievement = $achievementRepo->find($constitutionAchievements[$user->getConstitution()]);
                $user->addAchievement($achievement);

            }

        }
        if ($user->getCharisma() === $charismaAchievements) {
            if (array_key_exists($user->getCharisma(), $charismaAchievements)) {
                $achievement = $achievementRepo->find($charismaAchievements[$user->getCharisma()]);
                $user->addAchievement($achievement);

            }

        }


    }

    public function questDone(User $user , Task $task): void
    {
        $this->checkLvlStat($user, $task);
        $this->levelAchievements($user);
        $this->attributeAchievements($user);
    }
}
