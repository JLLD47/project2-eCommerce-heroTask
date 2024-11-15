<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $email = null;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(length: 100)]
    private ?string $username = null;

    #[ORM\Column(nullable: true)]
    private ?int $current_level = null;

    #[ORM\Column(nullable: true)]
    private ?int $current_xp = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $profession = null;

    #[ORM\Column(nullable: true)]
    private ?int $strength = null;

    #[ORM\Column(nullable: true)]
    private ?int $intelligence = null;

    #[ORM\Column(nullable: true)]
    private ?int $constitution = null;

    #[ORM\Column(nullable: true)]
    private ?int $charisma = null;

    #[ORM\Column(nullable: true)]
    private ?int $xp_required = null;

    #[ORM\OneToMany(targetEntity: Task::class, mappedBy: 'user')]
    private Collection $tasks;

    #[ORM\Column(nullable: true)]
    private ?int $str_xp_rq = 100;

    #[ORM\Column(nullable: true)]
    private ?int $int_xp_rq = 100;

    #[ORM\Column(nullable: true)]
    private ?int $const_xp_rq = 100;

    #[ORM\Column(nullable: true)]
    private ?int $cha_xp_rq = 100;

    #[ORM\Column(nullable: true)]
    private ?int $str_current = 0;

    #[ORM\Column(nullable: true)]
    private ?int $int_current = 0;

    #[ORM\Column(nullable: true)]
    private ?int $const_current = 0;

    #[ORM\Column(nullable: true)]
    private ?int $cha_current = 0;

    #[ORM\OneToMany(targetEntity: Achievements::class, mappedBy: 'user')]
    private Collection $achievements;

    public function __construct()
    {
        $this->tasks = new ArrayCollection();
        $this->achievements = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER

        return array_unique($roles);
    }

    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): static
    {
        $this->username = $username;

        return $this;
    }

    public function getCurrentLevel(): ?int
    {
        return $this->current_level;
    }

    public function setCurrentLevel(?int $current_level): static
    {
        $this->current_level = $current_level;

        return $this;
    }

    public function getCurrentXp(): ?int
    {
        return $this->current_xp;
    }

    public function setCurrentXp(?int $current_xp): static
    {
        $this->current_xp = $current_xp;

        return $this;
    }

    public function getProfession(): ?string
    {
        return $this->profession;
    }

    public function setProfession(?string $profession): static
    {
        $this->profession = $profession;

        return $this;
    }

    public function getStrength(): ?int
    {
        return $this->strength;
    }

    public function setStrength(?int $strength): static
    {
        $this->strength = $strength;

        return $this;
    }

    public function getIntelligence(): ?int
    {
        return $this->intelligence;
    }

    public function setIntelligence(?int $intelligence): static
    {
        $this->intelligence = $intelligence;

        return $this;
    }

    public function getConstitution(): ?int
    {
        return $this->constitution;
    }

    public function setConstitution(?int $constitution): static
    {
        $this->constitution = $constitution;

        return $this;
    }

    public function getCharisma(): ?int
    {
        return $this->charisma;
    }

    public function setCharisma(?int $charisma): static
    {
        $this->charisma = $charisma;

        return $this;
    }

    public function getXpRequired(): ?int
    {
        return $this->xp_required;
    }

    public function setXpRequired(?int $xp_required): static
    {
        $this->xp_required = $xp_required;

        return $this;
    }

    /**
     * @return Collection<int, Task>
     */
    public function getTasks(): Collection
    {
        return $this->tasks;
    }

    public function addTask(Task $task): static
    {
        if (!$this->tasks->contains($task)) {
            $this->tasks->add($task);
            $task->setUser($this);
        }

        return $this;
    }

    public function removeTask(Task $task): static
    {
        if ($this->tasks->removeElement($task)) {
            // set the owning side to null (unless already changed)
            if ($task->getUser() === $this) {
                $task->setUser(null);
            }
        }

        return $this;
    }

    public function getStrXpRq(): ?int
    {
        return $this->str_xp_rq;
    }

    public function setStrXpRq(?int $str_xp_rq): static
    {
        $this->str_xp_rq = $str_xp_rq;

        return $this;
    }

    public function getIntXpRq(): ?int
    {
        return $this->int_xp_rq;
    }

    public function setIntXpRq(?int $int_xp_rq): static
    {
        $this->int_xp_rq = $int_xp_rq;

        return $this;
    }

    public function getConstXpRq(): ?int
    {
        return $this->const_xp_rq;
    }

    public function setConstXpRq(?int $const_xp_rq): static
    {
        $this->const_xp_rq = $const_xp_rq;

        return $this;
    }

    public function getChaXpRq(): ?int
    {
        return $this->cha_xp_rq;
    }

    public function setChaXpRq(?int $cha_xp_rq): static
    {
        $this->cha_xp_rq = $cha_xp_rq;

        return $this;
    }

    public function getStrCurrent(): ?int
    {
        return $this->str_current;
    }

    public function setStrCurrent(?int $str_current): static
    {
        $this->str_current = $str_current;

        return $this;
    }

    public function getIntCurrent(): ?int
    {
        return $this->int_current;
    }

    public function setIntCurrent(int $int_current): static
    {
        $this->int_current = $int_current;

        return $this;
    }

    public function getConstCurrent(): ?int
    {
        return $this->const_current;
    }

    public function setConstCurrent(?int $const_current): static
    {
        $this->const_current = $const_current;

        return $this;
    }

    public function getChaCurrent(): ?int
    {
        return $this->cha_current;
    }

    public function setChaCurrent(?int $cha_current): static
    {
        $this->cha_current = $cha_current;

        return $this;
    }

    /**
     * @return Collection<int, Achievements>
     */
    public function getAchievements(): Collection
    {
        return $this->achievements;
    }

    public function addAchievement(Achievements $achievement): static
    {
        if (!$this->achievements->contains($achievement)) {
            $this->achievements->add($achievement);
            $achievement->setUser($this);
        }

        return $this;
    }

    public function removeAchievement(Achievements $achievement): static
    {
        if ($this->achievements->removeElement($achievement)) {
            // set the owning side to null (unless already changed)
            if ($achievement->getUser() === $this) {
                $achievement->setUser(null);
            }
        }

        return $this;
    }
}
