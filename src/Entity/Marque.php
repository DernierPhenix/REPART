<?php

namespace App\Entity;

use ORM\JoinColumn;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\MarqueRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Entity(repositoryClass: MarqueRepository::class)]
class Marque
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\OneToMany(mappedBy: 'marque', targetEntity: Produit::class)]
    #[ORM\JoinColumn(nullable: true)]
    private Collection $marques;

    public function __construct()
    {
        $this->marques = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * @return Collection<int, Produit>
     */
    public function getMarques(): Collection
    {
        return $this->marques;
    }

    public function addMarque(Produit $marque): self
    {
        if (!$this->marques->contains($marque)) {
            $this->marques->add($marque);
            $marque->setMarque($this);
        }

        return $this;
    }

    public function removeMarque(Produit $marque): self
    {
        if ($this->marques->removeElement($marque)) {
            // set the owning side to null (unless already changed)
            if ($marque->getMarque() === $this) {
                $marque->setMarque(null);
            }
        }

        return $this;
    }
}
