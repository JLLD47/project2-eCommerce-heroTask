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

    #[ORM\Column(nullable: true)]
    private ?int $strength_xp = null;

    #[ORM\Column]
    private ?int $intelligence_xp = null;

    #[ORM\Column(nullable: true)]
    private ?int $constitution_xp = null;

    #[ORM\Column(nullable: true)]
    private ?int $charisma_xp = null;

    #[ORM\OneToOne(inversedBy: 'taskStatid', cascade: ['persist', 'remove'])]
    private ?Task $task = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStrengthXp(): ?int
    {
        return $this->strength_xp;
    }

    public function setStrengthXp(?int $strength_xp): static
    {
        $this->strength_xp = $strength_xp;

        return $this;
    }

    public function getIntelligenceXp(): ?int
    {
        return $this->intelligence_xp;
    }

    public function setIntelligenceXp(int $intelligence_xp): static
    {
        $this->intelligence_xp = $intelligence_xp;

        return $this;
    }

    public function getConstitutionXp(): ?int
    {
        return $this->constitution_xp;
    }

    public function setConstitutionXp(?int $constitution_xp): static
    {
        $this->constitution_xp = $constitution_xp;

        return $this;
    }

    public function getCharismaXp(): ?int
    {
        return $this->charisma_xp;
    }

    public function setCharismaXp(?int $charisma_xp): static
    {
        $this->charisma_xp = $charisma_xp;

        return $this;
    }

    public function getTask(): ?Task
    {
        return $this->task;
    }

    public function setTask(?Task $task): static
    {
        $this->task = $task;

        return $this;
    }
}
