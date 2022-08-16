<?php

namespace App\Entity;

use App\Repository\CodeLanguageSkillRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CodeLanguageSkillRepository::class)]
class CodeLanguageSkill extends EntityBase
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?CodeLanguage $code_language = null;

    #[ORM\Column(length: 255)]
    private ?string $level = null;

    #[ORM\Column]
    private ?int $years = null;

    #[ORM\Column]
    private ?int $projects = null;

    #[ORM\ManyToOne(inversedBy: 'code_languages')]
    #[ORM\JoinColumn(nullable: false)]
    private ?CodingProfile $codingProfile = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $created = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $updated = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCodeLanguage(): ?CodeLanguage
    {
        return $this->code_language;
    }

    public function setCodeLanguage(?CodeLanguage $code_language): self
    {
        $this->code_language = $code_language;

        return $this;
    }

    public function getLevel(): ?string
    {
        return $this->level;
    }

    public function setLevel(string $level): self
    {
        $this->level = $level;

        return $this;
    }

    public function getYears(): ?int
    {
        return $this->years;
    }

    public function setYears(int $years): self
    {
        $this->years = $years;

        return $this;
    }

    public function getProjects(): ?int
    {
        return $this->projects;
    }

    public function setProjects(int $projects): self
    {
        $this->projects = $projects;

        return $this;
    }

    public function getCodingProfile(): ?CodingProfile
    {
        return $this->codingProfile;
    }

    public function setCodingProfile(?CodingProfile $codingProfile): self
    {
        $this->codingProfile = $codingProfile;

        return $this;
    }

    public function getCreated(): ?\DateTimeInterface
    {
        return $this->created;
    }

    public function setCreated(\DateTimeInterface $created): self
    {
        $this->created = $created;

        return $this;
    }

    public function getUpdated(): ?\DateTimeInterface
    {
        return $this->updated;
    }

    public function setUpdated(\DateTimeInterface $updated): self
    {
        $this->updated = $updated;

        return $this;
    }
}
