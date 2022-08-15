<?php

namespace App\Entity;

use App\Option\EmploymentStatus;
use App\Repository\JobProfileRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: JobProfileRepository::class)]
class JobProfile extends EntityBase
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(inversedBy: 'jobProfile', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Profile $profile = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $employment_status = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $employer = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $industry = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $position = null;

    #[ORM\OneToMany(mappedBy: 'jobProfile', targetEntity: Skill::class, orphanRemoval: true)]
    private Collection $skills;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?EducationDegree $education = null;

    #[ORM\Column(nullable: true)]
    private ?int $salary_expectation = null;

    public function __construct()
    {
        $this->skills = new ArrayCollection();
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

    public function getEmploymentStatus(): ?string
    {
        return $this->employment_status;
    }

    public function setEmploymentStatus(?string $employment_status): self
    {
        if (!empty($employment_status) && !EmploymentStatus::isValid($employment_status)) {
            $employment_status = EmploymentStatus::FulltimeEmployed->value;
        }

        $this->employment_status = $employment_status;

        return $this;
    }

    public function getEmployer(): ?string
    {
        return $this->employer;
    }

    public function setEmployer(?string $employer): self
    {
        $this->employer = $employer;

        return $this;
    }

    public function getIndustry(): ?string
    {
        return $this->industry;
    }

    public function setIndustry(?string $industry): self
    {
        $this->industry = $industry;

        return $this;
    }

    public function getPosition(): ?string
    {
        return $this->position;
    }

    public function setPosition(?string $position): self
    {
        $this->position = $position;

        return $this;
    }

    /**
     * @return Collection<int, Skill>
     */
    public function getSkills(): Collection
    {
        return $this->skills;
    }

    public function addSkill(Skill $skill): self
    {
        if (!$this->skills->contains($skill)) {
            $this->skills->add($skill);
            $skill->setJobProfile($this);
        }

        return $this;
    }

    public function removeSkill(Skill $skill): self
    {
        if ($this->skills->removeElement($skill)) {
            // set the owning side to null (unless already changed)
            if ($skill->getJobProfile() === $this) {
                $skill->setJobProfile(null);
            }
        }

        return $this;
    }

    public function getEducation(): ?EducationDegree
    {
        return $this->education;
    }

    public function setEducation(?EducationDegree $education): self
    {
        $this->education = $education;

        return $this;
    }

    public function getSalaryExpectation(): ?int
    {
        return $this->salary_expectation;
    }

    public function setSalaryExpectation(?int $salary_expectation): self
    {
        $this->salary_expectation = $salary_expectation;

        return $this;
    }
}
