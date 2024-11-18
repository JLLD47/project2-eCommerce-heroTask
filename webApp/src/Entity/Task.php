<?php

namespace App\Entity;

use App\Repository\TaskRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TaskRepository::class)]
class Task
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $description = null;

    #[ORM\Column]
    private ?bool $completed = false;

    #[ORM\Column(nullable: true)]
    private ?int $difficulty = 1;

    #[ORM\Column(nullable: true)]
    private ?int $xp_reward = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $recurrence = 'Once';

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $created_at = null;

    #[ORM\ManyToOne(inversedBy: 'tasks')]
    private ?User $user = null;

    #[ORM\OneToOne(mappedBy: 'task', cascade: ['persist', 'remove'])]
    private ?TaskStats $taskStatid = null;

    #[ORM\Column(length: 25, nullable: true)]
    private ?string $type = null;

    #[ORM\Column(nullable: true)]
    private ?bool $failed = false;

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function isCompleted(): ?bool
    {
        return $this->completed;
    }

    public function setCompleted(bool $completed): static
    {
        $this->completed = $completed;

        return $this;
    }

    public function getDifficulty(): ?int
    {
        return $this->difficulty;
    }

    public function setDifficulty(?int $difficulty): static
    {
        $this->difficulty = $difficulty;

        return $this;
    }

    public function getXpReward(): ?int
    {
        return $this->xp_reward;
    }

    public function setXpReward(?int $xp_reward): static
    {
        $this->xp_reward = $xp_reward;

        return $this;
    }

    public function getRecurrence(): ?string
    {
        return $this->recurrence;
    }

    public function setRecurrence(?string $recurrence): static
    {
        $this->recurrence = $recurrence;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(?\DateTimeImmutable $created_at): static
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function getTaskStatid(): ?TaskStats
    {
        return $this->taskStatid;
    }

    public function setTaskStatid(?TaskStats $taskStatid): static
    {
        // unset the owning side of the relation if necessary
        if ($taskStatid === null && $this->taskStatid !== null) {
            $this->taskStatid->setTask(null);
        }

        // set the owning side of the relation if necessary
        if ($taskStatid !== null && $taskStatid->getTask() !== $this) {
            $taskStatid->setTask($this);
        }

        $this->taskStatid = $taskStatid;

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function __construct()
    {
        $this->created_at = new \DateTimeImmutable();
    }

    public function isFailed(): ?bool
    {
        return $this->failed;
    }

    public function setFailed(?bool $failed): static
    {
        $this->failed = $failed;

        return $this;
    }





}
