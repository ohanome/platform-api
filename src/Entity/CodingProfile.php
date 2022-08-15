<?php

namespace App\Entity;

use App\Repository\CodingProfileRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CodingProfileRepository::class)]
class CodingProfile extends EntityBase
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(inversedBy: 'codingProfile', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Profile $profile = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $github = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $gitlab = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $bitbucket = null;

    #[ORM\OneToMany(mappedBy: 'codingProfile', targetEntity: CodeLanguageSkill::class, orphanRemoval: true)]
    private Collection $code_languages;

    #[ORM\ManyToMany(targetEntity: System::class)]
    private Collection $systems;

    public function __construct()
    {
        $this->code_languages = new ArrayCollection();
        $this->systems = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProfile(): ?Profile
    {
        return $this->profile;
    }

    public function setProfile(Profile $profile): self
    {
        $this->profile = $profile;

        return $this;
    }

    public function getGithub(): ?string
    {
        return $this->github;
    }

    public function setGithub(?string $github): self
    {
        $this->github = $github;

        return $this;
    }

    public function getGitlab(): ?string
    {
        return $this->gitlab;
    }

    public function setGitlab(?string $gitlab): self
    {
        $this->gitlab = $gitlab;

        return $this;
    }

    public function getBitbucket(): ?string
    {
        return $this->bitbucket;
    }

    public function setBitbucket(?string $bitbucket): self
    {
        $this->bitbucket = $bitbucket;

        return $this;
    }

    /**
     * @return Collection<int, CodeLanguageSkill>
     */
    public function getCodeLanguages(): Collection
    {
        return $this->code_languages;
    }

    public function addCodeLanguage(CodeLanguageSkill $codeLanguage): self
    {
        if (!$this->code_languages->contains($codeLanguage)) {
            $this->code_languages->add($codeLanguage);
            $codeLanguage->setCodingProfile($this);
        }

        return $this;
    }

    public function removeCodeLanguage(CodeLanguageSkill $codeLanguage): self
    {
        if ($this->code_languages->removeElement($codeLanguage)) {
            // set the owning side to null (unless already changed)
            if ($codeLanguage->getCodingProfile() === $this) {
                $codeLanguage->setCodingProfile(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, System>
     */
    public function getSystems(): Collection
    {
        return $this->systems;
    }

    public function addSystem(System $system): self
    {
        if (!$this->systems->contains($system)) {
            $this->systems->add($system);
        }

        return $this;
    }

    public function removeSystem(System $system): self
    {
        $this->systems->removeElement($system);

        return $this;
    }
}
