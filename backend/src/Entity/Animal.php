<?php

namespace App\Entity;

use App\Repository\AnimalRepository;
use Doctrine\Common\Collections\ArrayCollection;
use ApiPlatform\Metadata\ApiResource;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AnimalRepository::class)]
#[ApiResource]
class Animal
{
    public const STATUS = [];

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nomCommun = null;

    #[ORM\Column(length: 255)]
    private ?string $nomSavant = null;

    #[ORM\Column(length: 255)]
    private ?string $embranchement = null;

    #[ORM\Column(length: 255)]
    private ?string $classe = null;

    #[ORM\Column(length: 255)]
    private ?string $ordre = null;

    #[ORM\Column(length: 255)]
    private ?string $sousOrdre = null;

    #[ORM\Column(length: 255)]
    private ?string $famille = null;

    #[ORM\Column(length: 255)]
    private ?string $genre = null;

    #[ORM\Column(type: 'string', length: 2)]
    #[Assert\Choice(choices: ['EX', 'EW', 'CR', 'EN', 'VU', 'NT', 'LC', 'DD', 'NE'])]
    private ?string $statusConservation = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    /**
     * @var Collection<int, Observation>
     */
    #[ORM\OneToMany(targetEntity: Observation::class, mappedBy: 'idAnimal', orphanRemoval: true)]
    private Collection $observations;

    public function __construct()
    {
        $this->observations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomCommun(): ?string
    {
        return $this->nomCommun;
    }

    public function setNomCommun(string $nomCommun): static
    {
        $this->nomCommun = $nomCommun;

        return $this;
    }

    public function getNomSavant(): ?string
    {
        return $this->nomSavant;
    }

    public function setNomSavant(string $nomSavant): static
    {
        $this->nomSavant = $nomSavant;

        return $this;
    }

    public function getEmbranchement(): ?string
    {
        return $this->embranchement;
    }

    public function setEmbranchement(string $embranchement): static
    {
        $this->embranchement = $embranchement;

        return $this;
    }

    public function getClasse(): ?string
    {
        return $this->classe;
    }

    public function setClasse(string $classe): static
    {
        $this->classe = $classe;

        return $this;
    }

    public function getOrdre(): ?string
    {
        return $this->ordre;
    }

    public function setOrdre(string $ordre): static
    {
        $this->ordre = $ordre;

        return $this;
    }

    public function getSousOrdre(): ?string
    {
        return $this->sousOrdre;
    }

    public function setSousOrdre(string $sousOrdre): static
    {
        $this->sousOrdre = $sousOrdre;

        return $this;
    }

    public function getFamille(): ?string
    {
        return $this->famille;
    }

    public function setFamille(string $famille): static
    {
        $this->famille = $famille;

        return $this;
    }

    public function getGenre(): ?string
    {
        return $this->genre;
    }

    public function setGenre(string $genre): static
    {
        $this->genre = $genre;

        return $this;
    }

    public function getStatusConservation(): ?string
    {
        return $this->statusConservation;
    }

    public function setStatusConservation(string $statusConservation): static
    {
        $this->statusConservation = $statusConservation;

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

    /**
     * @return Collection<int, Observation>
     */
    public function getObservations(): Collection
    {
        return $this->observations;
    }

    public function addObservation(Observation $observation): static
    {
        if (!$this->observations->contains($observation)) {
            $this->observations->add($observation);
            $observation->setIdAnimal($this);
        }

        return $this;
    }

    public function removeObservation(Observation $observation): static
    {
        if ($this->observations->removeElement($observation)) {
            // set the owning side to null (unless already changed)
            if ($observation->getIdAnimal() === $this) {
                $observation->setIdAnimal(null);
            }
        }

        return $this;
    }
}
