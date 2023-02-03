<?php

namespace App\Entity;

use DateTime;
use DateTimeInterface;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\KillerRepository;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\HttpFoundation\File\File;
use Doctrine\Common\Collections\ArrayCollection;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: KillerRepository::class)]
#[Vich\Uploadable]
class Killer
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $avatar = null;

    #[Vich\UploadableField(mapping: 'avatar_file', fileNameProperty: 'avatar')]
    #[Assert\File(
    maxSize: '1M',
    mimeTypes: ['image/jpeg', 'image/png', 'image/webp'],
    )]
    private ?File $avatarFile = null;

    #[ORM\Column(nullable: true)]
    private array $skills = [];

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $biography = null;

    #[ORM\OneToMany(mappedBy: 'killer', targetEntity: Target::class)]
    private Collection $targets;

    #[ORM\OneToOne(mappedBy: 'killer', cascade: ['persist', 'remove'])]
    private ?User $user = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?DatetimeInterface $updatedAt = null;

    public function __construct()
    {
        $this->targets = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAvatar(): ?string
    {
        return $this->avatar;
    }

    public function setAvatar(?string $avatar): self
    {
        $this->avatar = $avatar;

        return $this;
    }

    public function getSkills(): array
    {
        return $this->skills;
    }

    public function setSkills(array $skills): self
    {
        $this->skills = $skills;

        return $this;
    }

    public function getBiography(): ?string
    {
        return $this->biography;
    }

    public function setBiography(?string $biography): self
    {
        $this->biography = $biography;

        return $this;
    }

    /**
     * @return Collection<int, Target>
     */
    public function getTargets(): Collection
    {
        return $this->targets;
    }

    public function addTarget(Target $target): self
    {
        if (!$this->targets->contains($target)) {
            $this->targets->add($target);
            $target->setKiller($this);
        }

        return $this;
    }

    public function removeTarget(Target $target): self
    {
        if ($this->targets->removeElement($target)) {
            // set the owning side to null (unless already changed)
            if ($target->getKiller() === $this) {
                $target->setKiller(null);
            }
        }

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        // unset the owning side of the relation if necessary
        if ($user === null && $this->user !== null) {
            $this->user->setKiller(null);
        }

        // set the owning side of the relation if necessary
        if ($user !== null && $user->getKiller() !== $this) {
            $user->setKiller($this);
        }

        $this->user = $user;

        return $this;
    }

    public function setAvatarFile(?File $avatarFile = null): void
    {
        $this->avatarFile = $avatarFile;
        if (null !== $avatarFile) {
            $this->updatedAt = new DateTime('now');
        }
    }

    public function getAvatarFile(): ?File
    {
        return $this->avatarFile;
    }

    /**
     * Get the value of updatedAt
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }
}