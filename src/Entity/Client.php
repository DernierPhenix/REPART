<?php

namespace App\Entity;


use Doctrine\ORM\Mapping as ORM;
use App\Repository\ClientRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

#[ORM\Entity(repositoryClass: ClientRepository::class)]
#[UniqueEntity('telephone',
message: 'Ce numéro de Téléphone est déjà enregistré'
)]
class Client
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['show_product'])]
    private ?int $id = null;
    
    #[Groups(['show_product'])]
    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[Groups(['show_product'])]
    #[ORM\Column(length: 255)]
    private ?string $prenom = null;

    #[Groups(['show_product'])]
    #[ORM\Column(length: 255)]
    private ?string $adresse = null;

    #[Groups(['show_product'])]
    #[ORM\Column]
    private ?int $cp = null;

    #[Groups(['show_product'])]
    #[ORM\Column(length: 255)]
    private ?string $ville = null;

    #[Groups(['show_product'])]
    #[ORM\Column(length: 255)]
    
    private ?string $telephone = null;

    #[Groups(['show_product'])]
    #[ORM\Column(length: 255)]
    #[Regex("/^([\w\.\-]+)@([\w\-]+)((\.(\w){2,4})+)$/", //Mise en place de la contrainte pour l'Email - Ne pas oublier d'importer la classe Regex
     message: 'Votre email est incorrect'
    )] 
    private ?string $email = null;

    #[Groups(['show_product'])]
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $raisonSociale = null;

    #[ORM\OneToMany(mappedBy: 'clients', targetEntity: Tickets::class)]
    private Collection $tickets;

    public function __construct()
    {
        $this->tickets = new ArrayCollection();
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

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getCp(): ?int
    {
        return $this->cp;
    }

    public function setCp(int $cp): self
    {
        $this->cp = $cp;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
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

    public function getRaisonSociale(): ?string
    {
        return $this->raisonSociale;
    }

    public function setRaisonSociale(?string $raisonSociale): self
    {
        $this->raisonSociale = $raisonSociale;

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
            $ticket->setClients($this);
        }

        return $this;
    }

    public function removeTicket(Tickets $ticket): self
    {
        if ($this->tickets->removeElement($ticket)) {
            // set the owning side to null (unless already changed)
            if ($ticket->getClients() === $this) {
                $ticket->setClients(null);
            }
        }

        return $this;
    }
}