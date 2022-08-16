<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User extends EntityBase implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $username = null;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column]
    private ?int $bits = null;

    #[ORM\Column]
    private ?bool $active = null;

    #[ORM\Column]
    private ?bool $verified = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Subscription $subscription = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Invitation $invitation = null;

    #[ORM\OneToOne(mappedBy: 'user', cascade: ['persist', 'remove'])]
    private ?Verification $verification = null;

    #[ORM\OneToOne(mappedBy: 'user', cascade: ['persist', 'remove'])]
    private ?UserSettings $userSettings = null;

    #[ORM\OneToMany(mappedBy: 'sender', targetEntity: BitTransaction::class)]
    private Collection $bitTransactions;

    #[ORM\OneToMany(mappedBy: 'receiver', targetEntity: BitTransaction::class)]
    private Collection $receivedBitTransactions;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Profile::class, orphanRemoval: true)]
    private Collection $profiles;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $created = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $updated = null;

    #[ORM\ManyToOne]
    private ?Profile $activeProfile = null;

    public function __construct()
    {
        $this->bitTransactions = new ArrayCollection();
        $this->receivedBitTransactions = new ArrayCollection();
        $this->profiles = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->username;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
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

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getBits(): ?int
    {
        return $this->bits;
    }

    public function setBits(int $bits): self
    {
        $this->bits = $bits;

        return $this;
    }

    public function isActive(): ?bool
    {
        return $this->active;
    }

    public function setActive(bool $active): self
    {
        $this->active = $active;

        return $this;
    }

    public function isVerified(): ?bool
    {
        return $this->verified;
    }

    public function setVerified(bool $verified): self
    {
        $this->verified = $verified;

        return $this;
    }

    public function getSubscription(): ?Subscription
    {
        return $this->subscription;
    }

    public function setSubscription(?Subscription $subscription): self
    {
        $this->subscription = $subscription;

        return $this;
    }

    public function getInvitation(): ?Invitation
    {
        return $this->invitation;
    }

    public function setInvitation(?Invitation $invitation): self
    {
        $this->invitation = $invitation;

        return $this;
    }

    public function getVerification(): ?Verification
    {
        return $this->verification;
    }

    public function setVerification(?Verification $verification): self
    {
        // unset the owning side of the relation if necessary
        if ($verification === null && $this->verification !== null) {
            $this->verification->setUser(null);
        }

        // set the owning side of the relation if necessary
        if ($verification !== null && $verification->getUser() !== $this) {
            $verification->setUser($this);
        }

        $this->verification = $verification;

        return $this;
    }

    public function getUserSettings(): ?UserSettings
    {
        return $this->userSettings;
    }

    public function setUserSettings(UserSettings $userSettings): self
    {
        // set the owning side of the relation if necessary
        if ($userSettings->getUser() !== $this) {
            $userSettings->setUser($this);
        }

        $this->userSettings = $userSettings;

        return $this;
    }

    /**
     * @return Collection<int, BitTransaction>
     */
    public function getBitTransactions(): Collection
    {
        return $this->bitTransactions;
    }

    public function addBitTransaction(BitTransaction $bitTransaction): self
    {
        if (!$this->bitTransactions->contains($bitTransaction)) {
            $this->bitTransactions->add($bitTransaction);
            $bitTransaction->setSender($this);
        }

        return $this;
    }

    public function removeBitTransaction(BitTransaction $bitTransaction): self
    {
        if ($this->bitTransactions->removeElement($bitTransaction)) {
            // set the owning side to null (unless already changed)
            if ($bitTransaction->getSender() === $this) {
                $bitTransaction->setSender(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, BitTransaction>
     */
    public function getReceivedBitTransactions(): Collection
    {
        return $this->receivedBitTransactions;
    }

    public function addReceivedBitTransaction(BitTransaction $receivedBitTransaction): self
    {
        if (!$this->receivedBitTransactions->contains($receivedBitTransaction)) {
            $this->receivedBitTransactions->add($receivedBitTransaction);
            $receivedBitTransaction->setReceiver($this);
        }

        return $this;
    }

    public function removeReceivedBitTransaction(BitTransaction $receivedBitTransaction): self
    {
        if ($this->receivedBitTransactions->removeElement($receivedBitTransaction)) {
            // set the owning side to null (unless already changed)
            if ($receivedBitTransaction->getReceiver() === $this) {
                $receivedBitTransaction->setReceiver(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Profile>
     */
    public function getProfiles(): Collection
    {
        return $this->profiles;
    }

    public function addProfile(Profile $profile): self
    {
        if (!$this->profiles->contains($profile)) {
            $this->profiles->add($profile);
            $profile->setUser($this);
        }

        return $this;
    }

    public function removeProfile(Profile $profile): self
    {
        if ($this->profiles->removeElement($profile)) {
            // set the owning side to null (unless already changed)
            if ($profile->getUser() === $this) {
                $profile->setUser(null);
            }
        }

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

    public function getActiveProfile(): ?Profile
    {
        return $this->activeProfile;
    }

    public function setActiveProfile(?Profile $activeProfile): self
    {
        $this->activeProfile = $activeProfile;

        return $this;
    }
}
