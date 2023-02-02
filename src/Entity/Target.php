<?php

namespace App\Entity;

use DateTime;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\TargetRepository;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\DBAL\Types\Types;

#[ORM\Entity(repositoryClass: TargetRepository::class)]
#[Vich\Uploadable]
#[UniqueEntity(
fields: ['firstname', 'lastname'],
errorPath: 'lastname',
message: 'This person is already targeted.',
)]
class Target
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $lastname = null;

    #[ORM\Column(length: 255)]
    private ?string $firstname = null;

    #[ORM\Column(length: 255)]
    private ?string $city = null;

    #[ORM\Column(length: 255)]
    private ?string $poster = null;

    #[Vich\UploadableField(mapping: 'poster_file', fileNameProperty: 'poster')]
    #[Assert\File(
        maxSize: '1M',
        mimeTypes: ['image/jpeg', 'image/png', 'image/webp'],
    )]
    private ?File $posterFile = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?DatetimeInterface $updatedAt = null;

    #[ORM\ManyToOne(inversedBy: 'targets')]
    private ?User $user = null;

    #[ORM\ManyToOne(inversedBy: 'targets')]
    private ?Killer $killer = null;

    #[ORM\Column]
    private ?bool $isKilled = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getPoster(): ?string
    {
        return $this->poster;
    }

    public function setPoster(?string $poster): self
    {
        $this->poster = $poster;

        return $this;
    }

    public function setPosterFile(?File $posterFile = null): void
    {
        $this->posterFile = $posterFile;
        if (null !== $posterFile) {
            $this->updatedAt = new DateTime('now');
        }
    }

    public function getPosterFile(): ?File
    {
        return $this->posterFile;
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

    public function getKiller(): ?Killer
    {
        return $this->killer;
    }

    public function setKiller(?Killer $killer): self
    {
        $this->killer = $killer;

        return $this;
    }

    public function isIsKilled(): ?bool
    {
        return $this->isKilled;
    }

    public function setIsKilled(bool $isKilled): self
    {
        $this->isKilled = $isKilled;

        return $this;
    }
}