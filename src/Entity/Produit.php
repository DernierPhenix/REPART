<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\ProduitRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: ProduitRepository::class)]
class Produit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['show_product'])]
    private ?int $id = null;


    #[ORM\ManyToOne(inversedBy: 'produits')]
    private ?SousCategorie $sousCategories = null;
    

    #[ORM\OneToMany(mappedBy: 'produits', targetEntity: Tickets::class, orphanRemoval:true)]
    private Collection $tickets;
    

    #[ORM\Column(length: 255)]
    #[Groups(['show_product'])]
    private ?string $modele = null;

    #[ORM\ManyToOne(inversedBy: 'marques')]
    private ?Marque $marque = null;
    

    public function __construct()
    {
        $this->tickets = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getModele(): ?string
    {
        return $this->modele;
    }

    public function setModele(string $modele): self
    {
        $this->modele = $modele;

        return $this;
    }

    public function getSousCategories(): ?SousCategorie
    {
        return $this->sousCategories;
    }

    public function setSousCategories(?SousCategorie $sousCategories): self
    {
        $this->sousCategories = $sousCategories;

        return $this;
    }

    /**
     * @return Collection<int, Tickets>
     */
    public function getTickets(): Collection
    {
        return $this->tickets;
    }

    public function addTicket(Tickets $ticket): self
    {
        if (!$this->tickets->contains($ticket)) {
            $this->tickets->add($ticket);
            $ticket->setProduits($this);
        }

        return $this;
    }

    public function removeTicket(Tickets $ticket): self
    {
        if ($this->tickets->removeElement($ticket)) {
            // set the owning side to null (unless already changed)
            if ($ticket->getProduits() === $this) {
                $ticket->setProduits(null);
            }
        }

        return $this;
    }

    public function getMarque(): ?Marque
    {
        return $this->marque;
    }

    public function setMarque(?Marque $marque): self
    {
        $this->marque = $marque;

        return $this;
    }

}
