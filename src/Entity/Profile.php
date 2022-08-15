<?php

namespace App\Entity;

use App\Repository\ProfileRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProfileRepository::class)]
class Profile
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'profiles')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\OneToOne(mappedBy: 'profile', cascade: ['persist', 'remove'])]
    private ?BaseProfile $baseProfile = null;

    #[ORM\OneToOne(mappedBy: 'profile', cascade: ['persist', 'remove'])]
    private ?JobProfile $jobProfile = null;

    #[ORM\OneToOne(mappedBy: 'profile', cascade: ['persist', 'remove'])]
    private ?SocialMediaProfile $socialMediaProfile = null;

    #[ORM\OneToOne(mappedBy: 'profile', cascade: ['persist', 'remove'])]
    private ?RelationshipProfile $relationshipProfile = null;

    #[ORM\OneToOne(mappedBy: 'profile', cascade: ['persist', 'remove'])]
    private ?GamingProfile $gamingProfile = null;

    #[ORM\OneToOne(mappedBy: 'profile', cascade: ['persist', 'remove'])]
    private ?CodingProfile $codingProfile = null;

    #[ORM\OneToMany(mappedBy: 'author', targetEntity: Post::class, orphanRemoval: true)]
    private Collection $posts;

    #[ORM\OneToMany(mappedBy: 'profile', targetEntity: Reaction::class, orphanRemoval: true)]
    private Collection $reactions;

    public function __construct()
    {
        $this->posts = new ArrayCollection();
        $this->reactions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getBaseProfile(): ?BaseProfile
    {
        return $this->baseProfile;
    }

    public function setBaseProfile(BaseProfile $baseProfile): self
    {
        // set the owning side of the relation if necessary
        if ($baseProfile->getProfile() !== $this) {
            $baseProfile->setProfile($this);
        }

        $this->baseProfile = $baseProfile;

        return $this;
    }

    public function getJobProfile(): ?JobProfile
    {
        return $this->jobProfile;
    }

    public function setJobProfile(JobProfile $jobProfile): self
    {
        // set the owning side of the relation if necessary
        if ($jobProfile->getProfile() !== $this) {
            $jobProfile->setProfile($this);
        }

        $this->jobProfile = $jobProfile;

        return $this;
    }

    public function getSocialMediaProfile(): ?SocialMediaProfile
    {
        return $this->socialMediaProfile;
    }

    public function setSocialMediaProfile(SocialMediaProfile $socialMediaProfile): self
    {
        // set the owning side of the relation if necessary
        if ($socialMediaProfile->getProfile() !== $this) {
            $socialMediaProfile->setProfile($this);
        }

        $this->socialMediaProfile = $socialMediaProfile;

        return $this;
    }

    public function getRelationshipProfile(): ?RelationshipProfile
    {
        return $this->relationshipProfile;
    }

    public function setRelationshipProfile(RelationshipProfile $relationshipProfile): self
    {
        // set the owning side of the relation if necessary
        if ($relationshipProfile->getProfile() !== $this) {
            $relationshipProfile->setProfile($this);
        }

        $this->relationshipProfile = $relationshipProfile;

        return $this;
    }

    public function getGamingProfile(): ?GamingProfile
    {
        return $this->gamingProfile;
    }

    public function setGamingProfile(GamingProfile $gamingProfile): self
    {
        // set the owning side of the relation if necessary
        if ($gamingProfile->getProfile() !== $this) {
            $gamingProfile->setProfile($this);
        }

        $this->gamingProfile = $gamingProfile;

        return $this;
    }

    public function getCodingProfile(): ?CodingProfile
    {
        return $this->codingProfile;
    }

    public function setCodingProfile(CodingProfile $codingProfile): self
    {
        // set the owning side of the relation if necessary
        if ($codingProfile->getProfile() !== $this) {
            $codingProfile->setProfile($this);
        }

        $this->codingProfile = $codingProfile;

        return $this;
    }

    /**
     * @return Collection<int, Post>
     */
    public function getPosts(): Collection
    {
        return $this->posts;
    }

    public function addPost(Post $post): self
    {
        if (!$this->posts->contains($post)) {
            $this->posts->add($post);
            $post->setAuthor($this);
        }

        return $this;
    }

    public function removePost(Post $post): self
    {
        if ($this->posts->removeElement($post)) {
            // set the owning side to null (unless already changed)
            if ($post->getAuthor() === $this) {
                $post->setAuthor(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Reaction>
     */
    public function getReactions(): Collection
    {
        return $this->reactions;
    }

    public function addReaction(Reaction $reaction): self
    {
        if (!$this->reactions->contains($reaction)) {
            $this->reactions->add($reaction);
            $reaction->setProfile($this);
        }

        return $this;
    }

    public function removeReaction(Reaction $reaction): self
    {
        if ($this->reactions->removeElement($reaction)) {
            // set the owning side to null (unless already changed)
            if ($reaction->getProfile() === $this) {
                $reaction->setProfile(null);
            }
        }

        return $this;
    }
}
