<?php

namespace App\Entity;

use App\Repository\ProfileRepository;
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
}
