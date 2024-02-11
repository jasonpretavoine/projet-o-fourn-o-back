<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['get_users_collection', 'get_user_item'])]
    private ?int $id = null;

    #[ORM\Column(length: 150)]
    #[Groups(['get_users_collection', 'get_user_item'])]
    private ?string $username = null;

    #[ORM\Column(length: 30)]
    #[Groups(['get_users_collection', 'get_user_item', 'get_recipe_item', 'get_reviews_collection', 'get_review_item'])]
    private ?string $pseudo = null;

    #[ORM\Column(length: 150)]
    #[Groups(['get_users_collection', 'get_user_item'])]
    private ?string $password = null;

    #[ORM\Column(length: 255)]
    #[Groups(['get_users_collection', 'get_user_item'])]
    private ?string $email = null;

    #[ORM\Column(length: 100)]
    #[Groups(['get_users_collection', 'get_user_item'])]
    private ?string $role = null;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Review::class, orphanRemoval: true)]
    private Collection $reviews;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Recipe::class)]
    private Collection $recipe;

    public function __construct()
    {
        $this->reviews = new ArrayCollection();
        $this->recipe = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getPseudo(): ?string
    {
        return $this->pseudo;
    }

    public function setPseudo(string $pseudo): static
    {
        $this->pseudo = $pseudo;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
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

    public function getRole(): ?string
    {
        return $this->role;
    }

    public function setRole(string $role): static
    {
        $this->role = $role;

        return $this;
    }

    /**
     * @return Collection<int, Review>
     */
    public function getReviews(): Collection
    {
        return $this->reviews;
    }

    public function addReview(Review $review): static
    {
        if (!$this->reviews->contains($review)) {
            $this->reviews->add($review);
            $review->setUser($this);
        }

        return $this;
    }

    public function removeReview(Review $review): static
    {
        if ($this->reviews->removeElement($review)) {
            // set the owning side to null (unless already changed)
            if ($review->getUser() === $this) {
                $review->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Recipe>
     */
    public function getRecipe(): Collection
    {
        return $this->recipe;
    }

    public function addRecipe(Recipe $recipe): static
    {
        if (!$this->recipe->contains($recipe)) {
            $this->recipe->add($recipe);
            $recipe->setUser($this);
        }

        return $this;
    }

    public function removeRecipe(Recipe $recipe): static
    {
        if ($this->recipe->removeElement($recipe)) {
            // set the owning side to null (unless already changed)
            if ($recipe->getUser() === $this) {
                $recipe->setUser(null);
            }
        }

        return $this;
    }
}
