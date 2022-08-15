<?php

namespace App\Entity;

use App\Option\RelationshipStatus;
use App\Option\RelationshipType;
use App\Option\Sexuality;
use App\Repository\RelationshipProfileRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RelationshipProfileRepository::class)]
class RelationshipProfile extends EntityBase
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(inversedBy: 'relationshipProfile', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Profile $profile = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $status = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $type = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $sexuality = null;

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

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(?string $status): self
    {
        if (!empty($status) && !RelationshipStatus::isValid($status)) {
            $status = RelationshipStatus::Single->value;
        }

        $this->status = $status;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): self
    {
        if (!empty($type) && !RelationshipType::isValid($type)) {
            $type = RelationshipType::Monogamy->value;
        }

        $this->type = $type;

        return $this;
    }

    public function getSexuality(): ?string
    {
        return $this->sexuality;
    }

    public function setSexuality(?string $sexuality): self
    {
        if (!empty($sexuality) && !Sexuality::isValid($sexuality)) {
            $sexuality = Sexuality::Heterosexual->value;
        }

        $this->sexuality = $sexuality;

        return $this;
    }
}
