<?php

namespace App\Entity;

use App\Repository\VoitureRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VoitureRepository::class)]
class Voiture
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: false)]
    private ?string $titre = null;

    #[ORM\Column(type: Types::TEXT, nullable: false)]
    private ?string $description = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $lien_image = null;

    #[ORM\Column]
    private ?float $prix_location = null;

    #[ORM\ManyToOne(inversedBy: 'voitures')]
    private ?Garage $garage = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): static
    {
        $this->titre = $titre;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getLienImage(): ?string
    {
        return $this->lien_image;
    }

    public function setLienImage(string $lien_image): static
    {
        $this->lien_image = $lien_image;

        return $this;
    }

    public function getPrixLocation(): ?float
    {
        return $this->prix_location;
    }

    public function setPrixLocation(float $prix_location): static
    {
        $this->prix_location = $prix_location;

        return $this;
    }

    public function getGarage(): ?Garage
    {
        return $this->garage;
    }

    public function setGarage(?Garage $garage): static
    {
        $this->garage = $garage;

        return $this;
    }
}
