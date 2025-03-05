<?php

namespace App\Entity;

use App\Repository\LieuRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LieuRepository::class)]
class Lieu
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $adresse = null;

    #[ORM\Column(length: 5)]
    private ?string $codepostal = null;

    #[ORM\Column(length: 255)]
    private ?string $ville = null;

    /**
     * @var Collection<int, Garage>
     */
    #[ORM\OneToMany(targetEntity: Garage::class, mappedBy: 'lieu')]
    private Collection $garage;

    public function __construct()
    {
        $this->garage = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): static
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getCodepostal(): ?string
    {
        return $this->codepostal;
    }

    public function setCodepostal(string $codepostal): static
    {
        $this->codepostal = $codepostal;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): static
    {
        $this->ville = $ville;

        return $this;
    }

    /**
     * @return Collection<int, Garage>
     */
    public function getGarage(): Collection
    {
        return $this->garage;
    }

    public function addGarage(Garage $garage): static
    {
        if (!$this->garage->contains($garage)) {
            $this->garage->add($garage);
            $garage->setLieu($this);
        }

        return $this;
    }

    public function removeGarage(Garage $garage): static
    {
        if ($this->garage->removeElement($garage)) {
            // set the owning side to null (unless already changed)
            if ($garage->getLieu() === $this) {
                $garage->setLieu(null);
            }
        }

        return $this;
    }
}
