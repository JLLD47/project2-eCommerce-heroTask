<?php

namespace App\Entity;

use App\Repository\TaskStatsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TaskStatsRepository::class)]
class TaskStats
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $strength_boost = null;

    #[ORM\Column]
    private ?int $intelligence_boost = null;

    #[ORM\Column]
    private ?int $constitution_boost = null;

    #[ORM\Column]
    private ?int $charisma_boost = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Task $taskId = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStrengthBoost(): ?int
    {
        return $this->strength_boost;
    }

    public function setStrengthBoost(int $strength_boost): static
    {
        $this->strength_boost = $strength_boost;

        return $this;
    }

    public function getIntelligenceBoost(): ?int
    {
        return $this->intelligence_boost;
    }

    public function setIntelligenceBoost(int $intelligence_boost): static
    {
        $this->intelligence_boost = $intelligence_boost;

        return $this;
    }

    public function getConstitutionBoost(): ?int
    {
        return $this->constitution_boost;
    }

    public function setConstitutionBoost(int $constitution_boost): static
    {
        $this->constitution_boost = $constitution_boost;

        return $this;
    }

    public function getCharismaBoost(): ?int
    {
        return $this->charisma_boost;
    }

    public function setCharismaBoost(int $charisma_boost): static
    {
        $this->charisma_boost = $charisma_boost;

        return $this;
    }

    public function getTaskId(): ?Task
    {
        return $this->taskId;
    }

    public function setTaskId(?Task $taskId): static
    {
        $this->taskId = $taskId;

        return $this;
    }
}
