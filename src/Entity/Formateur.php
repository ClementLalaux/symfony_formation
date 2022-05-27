<?php

namespace App\Entity;

use App\Repository\FormateurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FormateurRepository::class)]
class Formateur
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $nom;

    #[ORM\Column(type: 'string', length: 255)]
    private $prenom;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $numero_tel;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $email;

    #[ORM\ManyToMany(targetEntity: Session::class, mappedBy: 'formateur_id')]
    private $sessions_liste;

    #[ORM\ManyToMany(targetEntity: Promotion::class, mappedBy: 'formateur_id')]
    private $promotions_liste;

    public function __construct()
    {
        $this->sessions_liste = new ArrayCollection();
        $this->promotions_liste = new ArrayCollection();
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

    public function getNumeroTel(): ?string
    {
        return $this->numero_tel;
    }

    public function setNumeroTel(?string $numero_tel): self
    {
        $this->numero_tel = $numero_tel;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return Collection<int, Session>
     */
    public function getSessionsListe(): Collection
    {
        return $this->sessions_liste;
    }

    public function addSessionsListe(Session $sessionsListe): self
    {
        if (!$this->sessions_liste->contains($sessionsListe)) {
            $this->sessions_liste[] = $sessionsListe;
            $sessionsListe->addFormateurId($this);
        }

        return $this;
    }

    public function removeSessionsListe(Session $sessionsListe): self
    {
        if ($this->sessions_liste->removeElement($sessionsListe)) {
            $sessionsListe->removeFormateurId($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Promotion>
     */
    public function getPromotionsListe(): Collection
    {
        return $this->promotions_liste;
    }

    public function addPromotionsListe(Promotion $promotionsListe): self
    {
        if (!$this->promotions_liste->contains($promotionsListe)) {
            $this->promotions_liste[] = $promotionsListe;
            $promotionsListe->addFormateurId($this);
        }

        return $this;
    }

    public function removePromotionsListe(Promotion $promotionsListe): self
    {
        if ($this->promotions_liste->removeElement($promotionsListe)) {
            $promotionsListe->removeFormateurId($this);
        }

        return $this;
    }

    public function __toString()
    {
        return $this->getNom();
    }
}
