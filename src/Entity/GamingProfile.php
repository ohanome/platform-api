<?php

namespace App\Entity;

use App\Repository\GamingProfileRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GamingProfileRepository::class)]
class GamingProfile
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(inversedBy: 'gamingProfile', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Profile $profile = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $minecraft = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $valorant = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $league_of_legends = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $battle_net = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $ubisoft_connect = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $valve_steam = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $ea_origin = null;

    #[ORM\ManyToMany(targetEntity: Game::class)]
    private Collection $games;

    #[ORM\ManyToMany(targetEntity: GamingPlatform::class)]
    private Collection $platforms;

    public function __construct()
    {
        $this->games = new ArrayCollection();
        $this->platforms = new ArrayCollection();
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

    public function getMinecraft(): ?string
    {
        return $this->minecraft;
    }

    public function setMinecraft(?string $minecraft): self
    {
        $this->minecraft = $minecraft;

        return $this;
    }

    public function getValorant(): ?string
    {
        return $this->valorant;
    }

    public function setValorant(?string $valorant): self
    {
        $this->valorant = $valorant;

        return $this;
    }

    public function getLeagueOfLegends(): ?string
    {
        return $this->league_of_legends;
    }

    public function setLeagueOfLegends(?string $league_of_legends): self
    {
        $this->league_of_legends = $league_of_legends;

        return $this;
    }

    public function getBattleNet(): ?string
    {
        return $this->battle_net;
    }

    public function setBattleNet(?string $battle_net): self
    {
        $this->battle_net = $battle_net;

        return $this;
    }

    public function getUbisoftConnect(): ?string
    {
        return $this->ubisoft_connect;
    }

    public function setUbisoftConnect(?string $ubisoft_connect): self
    {
        $this->ubisoft_connect = $ubisoft_connect;

        return $this;
    }

    public function getValveSteam(): ?string
    {
        return $this->valve_steam;
    }

    public function setValveSteam(?string $valve_steam): self
    {
        $this->valve_steam = $valve_steam;

        return $this;
    }

    public function getEaOrigin(): ?string
    {
        return $this->ea_origin;
    }

    public function setEaOrigin(?string $ea_origin): self
    {
        $this->ea_origin = $ea_origin;

        return $this;
    }

    /**
     * @return Collection<int, Game>
     */
    public function getGames(): Collection
    {
        return $this->games;
    }

    public function addGame(Game $game): self
    {
        if (!$this->games->contains($game)) {
            $this->games->add($game);
        }

        return $this;
    }

    public function removeGame(Game $game): self
    {
        $this->games->removeElement($game);

        return $this;
    }

    /**
     * @return Collection<int, GamingPlatform>
     */
    public function getPlatforms(): Collection
    {
        return $this->platforms;
    }

    public function addPlatform(GamingPlatform $platform): self
    {
        if (!$this->platforms->contains($platform)) {
            $this->platforms->add($platform);
        }

        return $this;
    }

    public function removePlatform(GamingPlatform $platform): self
    {
        $this->platforms->removeElement($platform);

        return $this;
    }
}
