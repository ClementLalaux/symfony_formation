<?php

namespace App\Entity;

use App\Repository\PromotionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PromotionRepository::class)]
class Promotion
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $nom;

    #[ORM\OneToMany(mappedBy: 'promotion_id', targetEntity: Candidat::class)]
    private $candidats_liste;

    #[ORM\ManyToMany(targetEntity: Formateur::class, inversedBy: 'promotions_liste')]
    private $formateur_id;

    #[ORM\ManyToOne(targetEntity: Formation::class, inversedBy: 'promotions_liste')]
    private $formation_id;

    public function __construct()
    {
        $this->candidats_liste = new ArrayCollection();
        $this->formateur_id = new ArrayCollection();
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
     * @return Collection<int, Candidat>
     */
    public function getCandidatsListe(): Collection
    {
        return $this->candidats_liste;
    }

    public function addCandidatsListe(Candidat $candidatsListe): self
    {
        if (!$this->candidats_liste->contains($candidatsListe)) {
            $this->candidats_liste[] = $candidatsListe;
            $candidatsListe->setPromotionId($this);
        }

        return $this;
    }

    public function removeCandidatsListe(Candidat $candidatsListe): self
    {
        if ($this->candidats_liste->removeElement($candidatsListe)) {
            // set the owning side to null (unless already changed)
            if ($candidatsListe->getPromotionId() === $this) {
                $candidatsListe->setPromotionId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Formateur>
     */
    public function getFormateurId(): Collection
    {
        return $this->formateur_id;
    }

    public function addFormateurId(Formateur $formateurId): self
    {
        if (!$this->formateur_id->contains($formateurId)) {
            $this->formateur_id[] = $formateurId;
        }

        return $this;
    }

    public function removeFormateurId(Formateur $formateurId): self
    {
        $this->formateur_id->removeElement($formateurId);

        return $this;
    }

    public function getFormationId(): ?Formation
    {
        return $this->formation_id;
    }

    public function setFormationId(?Formation $formation_id): self
    {
        $this->formation_id = $formation_id;

        return $this;
    }

    public function __toString()
    {
        return $this->getNom();
    }
}
